@extends('layouts.default')

@section('content')
	<div class="jumbotron">
		<h1>一号车网 <small>后台管理系统</small></h1>
		<p class="lead">Menu management system, Roles management system.</p>
		<p><a class="btn btn-lg btn-success" href="{{ route('page', 'contact') }}">Contact us</a></p>
	</div>

	<div class="row marketing">
		<div class="col-lg-12">
			@include('content::_partial.channels')
		</div>
	</div>
@stop
