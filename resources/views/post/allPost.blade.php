@extends('layouts.header')

@section('content')
<style type="text/css">
	#postBody {
		border: 3px dotted magenta;
	}
	#description {
    	height:100px;
    	text-shadow: 0.1px 0.1px lime;
		overflow: auto; 
	}
	::selection {
		background: aquamarine;
	}
</style>

{{-- display the posts --}}
	<div class="content">
		<div class="outer">
			<div class="middle">
				<div class="inner">
					<center>
						@if(Session::has('message') && Session::has('success'))
						    <div class="alert {{ Session::get('success') ? 'alert-success' : 'alert-danger' }}">
						        {{Session::get('message')}}
						    </div>
						@endif
						<p>{{ App\Helpers\Helper::totalProduct() }}</p>
						@forelse ($allPost as $post)
							<div  id="postBody" class="card mb-3 card text-black bg-default mb-3">
								<h3 class="card-header"> {{ $post->title }} </h3>
								  <div class="card-body">
								  	<img style="height: 200px; width: 100%; display: block;" src="{{ asset('images/postPhoto/' .$post->photo)}}" alt="Card image">
								  <div class="card-body" id="description">
								    <p class="card-text"> {{ $post->description }} </p>
								  </div>
								  <ul class="list-group list-group-flush">
								    <li class="list-group-item"><footer class="blockquote-footer">Posted by:<i><a href="view/{{$post->author}}"> {{$post->author}}</a></i></footer></p></li>
								  </ul>
								  @if($post->author == Auth::user()->email)
								  @else
									  <div class="card-body">
									    <a href="like/{{base64_encode($post->id)}}" class="card-link">{{$post->likes}} Like</a>
									    <a href="dislike/{{base64_encode($post->id)}}" class="card-link">{{$post->dislikes}} Dislike</a>
									  </div>
								  @endif
								  <div class="card-footer text-muted">
								    {{$post->created_at->diffforHumans()}}<br>
								  </div>
								  	@if($post->author == Auth::user()->email)
									  	<div><br>
									  		{{-- edit --}}
									    	<a href="edit/{{base64_encode($post->id)}}"> <button type="button" class="btn btn-info"><i class="glyphicon glyphicon-info-sign"></i> Edit </button> </a>

									    	<button class="btn btn-danger"  data-toggle="modal" data-target="#confirm-delete-{{$post->id}}">
	   										 Delete 
											</button>

									    	<div class="modal fade" id="confirm-delete-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  										  <div class="modal-dialog">
	     										  <div class="modal-content">
		        									    <div class="modal-header">
		              										  <b>Confirm Delete ?</b>
		     										       </div>
		          										 <div class="modal-body">
		           		     								<i>Do you want to delete  {{$post->title}} ?</i>
		           										 </div>
		            									<div class="modal-footer">
		               									 <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		               										 <a class="btn btn-danger btn-ok" href="/delete/{{base64_encode($post->id)}}">Delete</a>
		            									</div>
	        										</div>
	   											 </div>
											 </div>
									    </div>
								    @else
								    @endif
								</div>
							</div>
							<hr style="height:4px;background-color:#3f4147;">
						@empty
							<center> No Posts </center>
						@endforelse
							<center>@include('layouts.footer')</center>
					</center>
				</div>
			</div>
		</div>
	</div>
@endsection
