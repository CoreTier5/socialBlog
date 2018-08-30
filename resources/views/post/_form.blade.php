{{-- jQuery validation script --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('form').validate({
            rules: {
                title: "required",
                description: {
                    required: true,
                    minLength: 10
                }
            },
            messages: {
                title: "Please enter a valid title for your post",
                description: {
                    required: "Description for your post can't be empty",
                    minLength: "Description atleast contain 10 character"
                }
            },
            errorClass: "error-class",
            validClass: "valid-class"
        });
    });
</script>

{{-- style for errors --}}
<style type="text/css">
    .error-class {
        color: #ff0000; /* red */
        display: block;
    }
    .valid-class {
        color: #00cc00; /* green */
    }
</style>
<style type="text/css">
    fieldset {
        border: 3px solid aqua;
        padding: 3px;
    }
</style>
<div class="inner">
  <fieldset>
      <center><h3>{{(isset($edit) && $edit == '1') ? 'Update your ': 'Create a'}} post here</h3>
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title"  placeholder="Title" value="{{ isset ($post) ? $post->title : old('title') }}">
          {{-- Display errors --}}
          @if($errors->has('title'))
            <div class="alert alert-danger">
              {{$errors->first('title')}}
            </div>
          @endif
      </div>
      <div class="form-group">
        <label for="Deccription">Description</label>
        <textarea class="form-control wmd-input processed" id="description" name="description" rows="6" placeholder="Write your post here" required> {{ isset($post) ? $post->description : old('description') }} </textarea>
        {{-- Display errors --}}
          @if($errors->has('description'))
            <div class="alert alert-danger">
              {{$errors->first('description')}}
            </div>
          @endif
      </div>
      <div>
        @if(@isset($edit) && $edit == '1')
          <input type="hidden" name="id" value="{{base64_encode($post->id)}}">        
        @else
        @endif
      </div>
      <div>
      	<label for="photo">Upload a photo for this post</label><br>
      	<input type="file" name="photo"  id="photo" class="form-control" >
        @if (isset($edit) && $edit == '1' && ($post->photo != 'default.jpg'))
          {{ isset ($post) ? 'Already Uploaded' : 'Upload a new' }}
        @endif
      </div><br>
      <div><br>
      	<button type="submit" class="btn btn-success">{{(isset($edit) && $edit == '1') ? 'Update': 'Post'}}</button>
        @if(isset($edit) && $edit == '1')
          <a href="{{ URL::previous() }}"> <input type="button" class="btn btn-warning" value="Cancel"> </a>
        @endif
  	</div>
    </center>
  </fieldset>
</div>