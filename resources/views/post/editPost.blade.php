@extends('layouts.header')

@section('content')

	<form  action="{{route('update.post')}}" method="POST" enctype="multipart/form-data">
		@csrf
		 @include('post._form',['edit' => 1,'post' => $post])
		
	</form>

@endsection