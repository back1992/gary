@extends('admin.layouts.default')

@section('content')
	<div class="col-lg-123">
		<h2>PHPINFO</h2>

		{{phpinfo()}}
	</div>
@stop
