@extends('admin.layouts.default')

@section('content')
<div class="jumbotron">
   <p class="lead">   Hi  <span class="text-primary">  {{$user->username}} </span> 欢迎光临 </p>
	<h1>GARY <small>后台管理系统</small></h1>
	<p class="lead">Menu management system, Roles management system.</p>
	<p><a class="btn btn-lg btn-success" href="{{ route('page', 'contact') }}">Contact us</a></p>
</div>
@stop


