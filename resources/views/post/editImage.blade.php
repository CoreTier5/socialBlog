@extends('layouts.header')

@section('content')

{{-- display the posts --}}
    <div class="content">
        <div class="outer">
            <div class="middle">
                <div class="inner">
                    <center>
                        <div  style="border: 2px dotted turquoise ;" id="postBody" class="card mb-3 card text-black bg-default mb-3">
                            <div class="card-body" style="text-align: center;position: relative" id="image">
                                <div class="card-body">
                                    <img width="100%" height="100%" id="preview_image" src="{{asset('images/postPhoto/' .$post->photo)}}"/>
                                    <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
                                </div>
                            </div>
                            <div class="card-body" id="description">
                                <p class="card-text"> {{ $post->description }} </p>
                            </div>
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><footer class="blockquote-footer">Posted by:<i><a href="view/{{$post->author}}"> {{$post->author}}</a></i></footer></p></li>
                                  </ul>
                            <div class="card-footer">
                                @if($post->author == Auth::user()->email)
                                    <a href="javascript:changeProfile()" style="text-decoration: none;">
                                        <i class="glyphicon glyphicon-edit"></i> Change
                                    </a>                                    
                                    <input type="file" id="file" style="display: none"/>
                                    <input type="hidden" id="file_name"/>
                                @else
                                    <a href="like/{{base64_encode($post->id)}}" class="card-link">{{$post->likes}} Like</a>
                                    <a href="dislike/{{base64_encode($post->id)}}" class="card-link">{{$post->dislikes}} Dislike</a>
                                @endif
                            </div>                            
                            <input type="hidden" name="id" id="id" value="{{$post->id}}">
                        </div>
                        <form action="/uploadimage" class="dropzone" method="post" id="dropzone" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$post->id}}">
                          <div id="dropzone" class="fallback">
                          </div>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
<script>
    Dropzone.options.dropzone = {
        success: function success(file,response) {
            if (file.previewElement) {
                $('#preview_image').attr('src', '{{ asset('images/postPhoto')}}/'+response);
                swal({
                    title: "Done",
                    text: "Image changed successfully",
                    icon: "success"
                });  
            }
        },
    }
    
    function changeProfile() {
        $('#file').click();
    }
    $('#file').change(function () {
        if ($(this).val() != '') {
            upload(this);
        }
    });
    function upload(img) {
        var id = $('#id').val();
        var form_data = new FormData();
        form_data.append('file', img.files[0]);
        form_data.append('id',id);
        form_data.append('_token', '{{csrf_token()}}');
        $('#loading').css('display', 'block');
        $.ajax({
            url: "{{url('/uploadimage')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    $('#preview_image').attr('src', '{{asset('images/postPhoto/' .$post->photo)}}');
                    swal(data.errors['file']);
                }
                else {
                    swal({
                      title: "Done",
                      text: "Image changed successfully",
                      icon: "success",
                    });
                    $('#file_name').val(data);
                    $('#preview_image').attr('src', '{{asset('images/postPhoto/')}}/' + data);
                }
                $('#loading').css('display', 'none');
            },
            error: function (xhr, status, error) {
                swal(xhr.responseText);
                $('#preview_image').attr('src', '{{asset('images/postPhoto/' .$post->photo)}}');
            }
        });
    }
</script>
@endsection