@extends('admin.layouts.default')
@section('content')
<div class="row">
	<div class="col-md-8">  
		<div class="well">
			<p class="lead"><a href="{{ url('admin/menu')}}" class="btn btn-default pull-right">Go Back</a> Menu:</p>

			{{ Form::model($item, array('url' => "admin/menu/edit/{$item->id}", 'class' => 'form-horizontal')) }}
			<div class="form-group">
				<label for="title" class="col-lg-2 control-label">Title</label>
				<div class="col-lg-10">
					{{ Form::text('title',null,array('class'=>'form-control'))}}
				</div>
			</div>
			<div class="form-group">
				<label for="label" class="col-lg-2 control-label">Label</label>
				<div class="col-lg-10">
					{{ Form::text('label',null,array('class'=>'form-control'))}}
				</div>
			</div>
			<div class="form-group">
				<label for="url" class="col-lg-2 control-label">URL</label>
				<div class="col-lg-10">
					{{ Form::text('url',null,array('class'=>'form-control'))}}
				</div>
			</div>
			<div class="form-group {{{ $errors->has('roles') ? 'error' : '' }}}">
				<label class="col-md-2 control-label" for="roles">Roles</label>
				<div class="col-md-6">
					<select class="form-control" name="roles[]" id="roles[]" multiple>
						@foreach ($roles as $role)
						@if ($mode == 'create')
						<option value="{{{ $role->id }}}"{{{ ( in_array($role->id, $selectedRoles) ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
						@else
						<option value="{{{ $role->id }}}"{{{ ( array_search($role->id, $user->currentRoleIds()) !== false && array_search($role->id, $user->currentRoleIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
						@endif
						@endforeach
					</select>

					<span class="help-block">
						Select a group to assign to the menu, remember that a user can only access the menu he assigned.
					</span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6 col-md-offset-6 text-right">
				<button type="submit" class="btn btn-lg btn-default">Update Menu</button>
				</div>
			</div>
			<!-- ./ groups -->
			{{ Form::close()}}
		</div>
	</div>

</div>
@stop

