@extends('layouts.header')

@section('content')

<div class="outer">	
	<div class="inner">			
		@forelse ($value as $post)
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
			    No Post found
			  </li>
			</ul>
		@endforelse			
	</div>
</div>

@endsection