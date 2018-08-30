@extends('layouts.header')

@section('content')

<div class="jumbotron">
  <h3 class="display-3">{{$profile->firstName}}&nbsp{{$profile->lastName}}</h3>
  <p class="lead">User email: {{$profile->email}}</p>
  <hr class="my-4">
  <img src="{{ asset('images/profilePhotos/' .$profile->profilePhoto)}}"  class="rounded float-left" height="200" width="200"><br>
  <p align="right">{{$profile->firstName}} joins social blog {{$profile->created_at->diffforHumans()}}</p>
  <p align="center" class="lead">
    <a class="btn btn-primary btn-lg" href="/allPost" role="button">Back</a>
  </p>
</div>

<hr style="height:4px;background-color:#457812;" />
<center><h3> {{$profile->firstName}}'s posts </h3></center>
{{-- display the posts --}}

@forelse($posts as $show)
 <div class="outer">
  <div class="middle">
    <div class="inner">
      <center>
         <div class="card mb-3">
            <h3 class="card-header"> {{ $show->title }} </h3>
              <div class="card-body">
              <img style="height: 200px; width: 100%; display: block;" src="{{ asset('images/postPhoto/' .$show->photo)}}" alt="Card image">
              <div class="card-body">
                <p class="card-text"> {{ $show->description }} </p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><footer class="blockquote-footer">Posted by:<i><a href="view/{{$show->author}}"> {{$show->author}}</a></i></footer></p></li>
              </ul>
              @if($show->author == Auth::user()->email)
              @else
                <div class="card-body">
                  <a href="like/{{base64_encode($show->id)}}" class="card-link">{{$show->likes}} Like</a>
                  <a href="dislike/{{base64_encode($show->id)}}" class="card-link">{{$show->dislikes}} Dislike</a>
                </div>
              @endif
              <div class="card-footer text-muted">
                {{$show->created_at->diffforHumans()}}<br>
              </div>
                @if($show->author == Auth::user()->email)
                <div><br>
                  {{-- edit --}}
                  <a href="edit/{{base64_encode($show->id)}}"> <button type="button" class="btn btn-info"> Edit </button> </a>
                  {{-- delete --}}
                  {!! Form::open(['method' => 'DELETE','route' => ['post.destroy', base64_encode($show->id)],'style'=>'display:inline']) !!}
                      {!! Form::button('Delete', ['class' => 'btn btn-danger','data-toggle'=>'confirmation']) !!}
                      {!! Form::close() !!}

                </div>
                @else
                @endif
            </div>
          </div>
        <hr style="height:4px;background-color:#457812;" />
      </center>
    </div>
  </div>
</div>
@empty
  <center>
    <div class="card text-white bg-info mb-3" style="max-width: 20rem;">
      <div class="card-header">
        No Post
      </div>
      @if($profile->email == Auth::user()->email)
          <div class="card-body">
            <h4 class="card-title">You have no post.</h4>
            <p class="card-text">Create a new post in socialBolg !</p>
          </div>
      @else
          <div class="card-body">
            <h4 class="card-title">{{$profile->firstName}} has no post.</h4>
            <p class="card-text">If you know {{$profile->firstName}} personally then encourage to post in social blog !</p>
          </div>
      @endif
    </div>
  </center>
@endforelse
      

@endsection

