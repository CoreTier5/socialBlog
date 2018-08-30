@extends('layouts.header')

<!-- jQuery -->
<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
</head>

@section('content')
	<form method="POST" action="/createPost" enctype="multipart/form-data">
		@csrf
		 @include('post._form',['edit' => 0])
		
	</form>
@endsection
