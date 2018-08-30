<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\User;

class SearchController extends Controller
{
    /*
	 * Search User and Post
	 */
	public function search(Request $request)
	{
		try
		{
			$valuePost = Posts::where('title','LIKE','%'.$request->key.'%')->first();
            if(!$valuePost)
            {
                $valuePost = Posts::where('description','LIKE','%'.$request->key.'%')->get();
            }
            $valuePost = Posts::where('title','LIKE','%'.$request->key.'%')->get();

			$value = User::where('firstName',$request->key)->first();
			if(!$value)
			{
				$value = User::where('lastName',$request->key)->get();
				return view('users.searchUserResult',compact('value','request','valuePost'));
			}
			$value = User::where('firstName',$request->key)->get();
			return view('users.searchUserResult',compact('value','request','valuePost'));			
		}
		catch(Exception $exception)
		{
			return $exception;
		}
	}
}
