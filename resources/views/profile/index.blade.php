@extends('layouts.app')


@section('content')
<div class="col-lg-4">
	<div class="panel panel-default">
		<div class="panel-heading text-center">{{ $user->name }}'s Profile</div>
		<div class="panel-body">			
			<center>
				<img src="{{ $user->avatar }}" width="140px" height="140px" style="border-radius: 50%;" alt="">	
			</center>
			<br>
			
			<p class="text-center">
				@if(Auth::id() == $user->id)
					<a href="{{ route('profile.edit') }}" class="btn btn-info">Edit your Profile</a>
				@endif				
			</p>
			
			<br>
			<strong>Location: </strong> <small><b>{{ $user->profile->location }}</b></small>
		</div>		
	</div>
	
	@if(Auth::id() != $user->id)
		<div class="panel panel-default">		
			<div class="panel-body">
				<friend :profile_user_id="{{ $user->id }}"></friend>
			</div>	
		</div>
	@endif
	
	<div class="panel panel-default">
		<div class="panel-heading text-center">About me</div>
			<div class="panel-body">
				{{ $user->profile->about }}
			</div>
		</div>
	</div>
</div>


@endsection