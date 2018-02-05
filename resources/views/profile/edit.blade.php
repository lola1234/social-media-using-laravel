@extends('layouts.app')


@section('content')
<div class="col-lg-6">
	<div class="panel panel-default">
		<div class="panel-heading text-center">Edit your Profile</div>
		<div class="panel-body">
			<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
			<div class="form-group">
				<label for="avatar">Avatar</label>
				<input type="file" name="avatar" class="form-control" accept="image/">
			</div>
			
			<div class="form-group">
				<label for="about">About me</label>
				<textarea name="about" id="about" cols="5" rows="5" class="form-control" required>{{$profile->about}}</textarea>
			</div>
			
			<div class="form-group">
				<label for="location">Location</label>
				<input type="text" name="location" value="{{$profile->location}}" class="form-control" required>
			</div>
			
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Update</button>
			</div>
			</form>
		</div>
	</div>	
</div>


@endsection