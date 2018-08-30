@extends('layouts.header')

@section('content')

<div class="outer">	
	<div class="inner">
		<ul class="nav nav-tabs">
		  <li class="nav-item">
		    <a class="nav-link active" data-toggle="tab" href="#users">Users</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" data-toggle="tab" href="#posts">Posts</a>
		  </li>
		</ul>
		<div id="myTabContent" class="tab-content">
		  <div class="tab-pane fade active" id="users">
		    @forelse ($value as $user)
				<ul class="list-group">
				  <li class="list-group-item d-flex justify-content-between align-items-center">
				    <img class="media-object img-rounded" src="{{ asset('images/profilePhotos/' .$user->profilePhoto)}}" height="100" width="100"> {{$user->firstName}} {{$user->lastName}}
				    <a href="view/{{$user->email}}"> <span class="badge badge-primary badge-pill">Visit Profile</span></a>
				  </li>
				</ul>
			@empty
				<ul class="list-group">
				  <li class="list-group-item d-flex justify-content-between align-items-center">
				    No User found with name '{{$request->key}}'.
				  </li>
				</ul>
			@endforelse
		  </div>
		  <div class="tab-pane fade" id="posts">
		    @forelse ($valuePost as $post)
					<ul class="list-group">
						<center>
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    <img class="media-object img-rounded" src="{{ asset('images/postPhoto/' .$post->photo)}}" height="100" width="100"> {{$post->title}}<br>
						    {{$post->description}}
						    <a href="view/{{$post->title}}"> <span class="badge badge-primary badge-pill">View Post</span></a>
					     </li>
					    </center>
					</ul>
				@empty
					<ul class="list-group">
					  <li class="list-group-item d-flex justify-content-between align-items-center">
					    No Post found with name '{{$request->key}}'.
					  </li>
					</ul>
				@endforelse	
		  </div>
		</div>
	</div>
</div>

@endsection