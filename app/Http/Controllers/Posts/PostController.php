<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Posts;
use App\User;
use Image;
use Auth;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostsResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPost = Posts::orderBy('id', 'DESC')->get();
        return view('post.allPost',compact('allPost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.createPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try
        {
            $post               = new Posts();
            $post->title        = $request->title;
            $post->description  = $request->description;
            $post->author       = Auth::user()->email;
            if($request->hasfile('photo'))
            { 
                $photo = $request->file('photo');
                $photoname =time().'.'.$photo->getClientOriginalExtension();
                Image::make($photo)->save(public_path('images/postPhoto/' . $photoname));
                $post->photo = $photoname;
            }
            $post->save();

            return redirect()->route('all.post');
        }
        catch(\Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $id)
    {
        //return new PostsResource($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd('fds');
        $post = Posts::findOrFail(base64_decode($id));
        return view('post.editPost',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $post               = Posts::findOrFail(base64_decode($request->id));
            $post->title        = $request->title;
            $post->description  = $request->description;
            $post->update();
            return redirect()->route('all.post')->with(['success' => true, 'message' => "Post '".$request->title."' edited successfully "]);
        }
        catch(Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd(base64_decode($id));
        try
        {
            $post = Posts::findOrFail(base64_decode($id));
            if($post->author == Auth::user()->email)
            {
                $post->delete();
                return redirect()->route('all.post')->with(['success' => true, 'message' => "Post deleted successfully "]);
            }
            
            else
            {
               return redirect()->route('all.post')->with(['success' => false, 'message' => "Something Wrong "]); 
            }
            
        }
        catch(Exception $exception)
        {
            return $exception->getMessage();
        }

    }

    /*
     * Post like controller
     */
    public function likePost($id)
    {
        try 
        {
            $post = Posts::findOrFail(base64_decode($id));
            if ($post)
            {
                if($post->author == Auth::user()->email)
                {
                    return redirect()->route('all.post')->with(['success' => false, 'message' => "You cannot like your own post "]); 
                } 
                $post->increment('likes');
                return redirect()->route('all.post');
            }
            else
            {
                return redirect()->route('all.post');
            }
           
        }
         catch (Exception $exception)
        {
            return $exception->getMessage();   
        }
    }

    /*
     * Post like controller
     */
    public function disLikePost($id)
    {
        try 
        {
            $post = Posts::findOrFail(base64_decode($id));
            if ($post)
            {
                $post->increment('dislikes');
                return redirect()->route('all.post');
            }
            else
            {
                return redirect()->route('all.post');
            }
            
        }
         catch (Exception $exception)
        {
            return $exception->getMessage();   
        }
    }    

    /*
     * Search Post controller
     */
    public function searchPost($key)
    {
        try
        {   
            $value = Posts::where('title','LIKE','%'.$key.'%')->first();
            if(!$value)
            {
                $value = Posts::where('description','LIKE','%'.$key.'%')->get();
                return view('post.searchPostResults',compact('value'));
            }
            $value = Posts::where('title','LIKE','%'.$key.'%')->get();
            return view('post.searchPostResults',compact('value'));           
        }
        catch(Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    /**
     * Function to edit image with ajax
     * @return [type] [description]
     */
    public function editImage($id)
    {
        $post = Posts::findOrFail($id);
        return view('post.editImage',compact('post'));
    }

    public function editImageAjax(Request $request)
    {   
        $post = Posts::findOrFail($request->id);
        if($request->hasfile('file'))
            { 
                $photo = $request->file('file');
                $photoname =time().'.'.$photo->getClientOriginalExtension();
                Image::make($photo)->save(public_path('images/postPhoto/' . $photoname));
                $post->photo = $photoname;
            }
        $post->update();
        // return redirect('/editImage/'.$request->id)->with(['success' => true, 'message' => "Post '".$request->title."' edited successfully "]);
        return $photoname;
    }

    /*
     * Test API
     */
    // public function api()
    // {
    //     echo $api = Posts::all();
    // }

}
