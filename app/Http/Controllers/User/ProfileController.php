<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Posts;
use App\User;
use Auth;

class ProfileController extends Controller
{
    
	/*
	 * View user profile 
	 */
    public function viewProfile($user_email)
    {
	    try{
		    	$profile = User::where('email',$user_email) -> first();
		    	if($profile)
		    	{
		    		$posts = Posts::where('author',$user_email)->get();
		    		return view('users.userProfile',compact('profile','posts'));
		    	}
		    	else
		    	{
		    		return view('errors.404');
		    	}
		    }
		catch(Exception $exception)
		{
			return $exception;
		}
	}

	/*
	 * View current user profile
	 */
	 public function viewCurrentUser()
    {
	    try{
		    	$profile = User::where('email',Auth::user()->email) -> first();
		    	if($profile)
		    	{
		    		$posts = Posts::where('author',Auth::user()->email)->get();
		    		return view('users.userProfile',compact('profile','posts'));
		    	}
		    	else
		    	{
		    		return view('errors.404');
		    	}
		    }
		catch(Exception $exception)
		{
			return $exception;
		}
	}


}
