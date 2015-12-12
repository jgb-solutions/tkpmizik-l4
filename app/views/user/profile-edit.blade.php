@extends('layout.nosidebar')

@section('content')

<div class="col-sm-8 col-sm-offset-2">

	@if ( Session::has('message') )
		<div class="alert alert-info fade in" role="alert">
      		<button type="button" class="close" data-dismiss="alert">
      			<span aria-hidden="true">×</span>
      			<span class="sr-only">Close</span>
      		</button>
      		<h2>{{ Session::get('message') }}</h2>
    	</div>
	@endif

	<div class="bg-danger">

		@if( $errors )
			<ul class="list-unstyled">
				@foreach ( $errors->all('<li>:message</li>') as $error )
					{{ $error }}
				@endforeach
			</ul>
		@endif

	</div>

	{{ Form::open(array('method' => 'PUT', 'enctype' => 'multipart/form-data' )) }}

		<div class="form-group">
			<label for="regname">Name</label>
			<input name="name" type="name" class="form-control" id="regname" placeholder="Enter your name" required value="{{ Auth::user()->name }}">
		</div>
		<div class="form-group">
			<label for="regemail">Email address</label>
			<input name="email" type="email" class="form-control" id="regemail" placeholder="Enter email" required value="{{ Auth::user()->email }}">
		</div>
		<div class="form-group">
			<label for="regpassword">New Password</label>
			<input name="password" type="password" class="form-control" id="regpassword" placeholder="Enter your new Password">
		</div>
		<div class="form-group">
			<label for="regpasswordconfirm">Re-enter your new Password</label>
			<input name="password_confirm" type="password" class="form-control" id="regpasswordconfirm" placeholder="Re-enter your new Password">
		</div>

		<div class="form-group">
			<label for="image">Profile Image</label>
			<input type="file" name="image" id="image" class="form-control">
		</div>

		<button type="submit" class="btn btn-primary">Update Profile</button>

	{{ Form::close() }}

	<br>

</div>

@stop