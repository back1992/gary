@extends('admin.layouts.default')
@section('content')
<div class="jumbotron">
	<p class="lead">   Hi  <span class="text-primary">  {{(!is_null($user)) ? $user->username : '' }} </span> 欢迎光临 </p>
	<h1><small>{{$menuName}} 的页面</small></h1>

	<p class="lead">
		以下权限不能看到这个页面.</p>
		<p><a class="btn btn-lg btn-success" href="{{ route('page', 'contact') }}">Contact us</a></p>
	</div>
@stop



