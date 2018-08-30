<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\PasswordReset;
use App\User;
use Mail;

class PasswordResetController extends Controller
{
   /*
    * Create a token for reset function here
    */
    public function index(Request $request)
    {
    	try
    	{
    		$user = User::whereEmail($request->email)->first();
    		if($user)
    		{
    			//Generating random token
    			$token			=	str_random(64);
				
				//Saving the token in password reset table with token
				$reset			=	new PasswordReset;
				$reset->email	=	$request->email;
				$reset->token	=	$token;
				// dd($reset);
				$reset->save();
    		}
    		else
    		{
    			return redirect()->back()->with(['success' => false, 'message' => "User does not exist plese try again or register."]);
    		}

    		Mail::send('users.resetMail',['email' => $user->email,'token' => $reset->token,'user_id' => base64_encode($user->id),'user'=>$user->firstName],
          	function($message) use($request) {
          	$message->from('work@tier5.us','SocialBlog');
          	$message->to($request->email)->subject('Reset your password');
          });

            dd("Password Reset mail sent to your email.");
    	}
    	catch(Exception $exception)
    	{
    		return $exception;
    	}
    }

    /*
     * Password reset link check
     */
    public function reset()
    {
    	try 
    	{
    		$token = (Input::has('token')) ? Input::get('token') : null;
			$user_id = (Input::has('user_id')) ? Input::get('user_id') : null;

			$reset 	=	PasswordReset::where('token',$token)->exists();
			if(!$reset)
			{
				dd("Invalid token or token got expired.");
			}
			else
			{
				return view('users.resetUserPassword',[
					'token'		=>	$token,
					'user_id'	=>	$user_id	
				]);
			}
    	} 
    	catch (Exception $exception) 
    	{
    		return $exception;
    	}
    }

    /*
     * New password creator for user
     */
    public function newPassword(Request $request)
    {
    	try
    	{
    		$newPassword	=	User::find(base64_decode($request->user_id));
    		if ($newPassword)
    		{
    			$newPassword->password 	=	Hash::make($request->password);
    			$newPassword->update();
    			PasswordReset::where('token',$request->token)->delete();
    			return redirect()->route('user.login')->with(['success' => true, 'message' => "Password changed successfully. Please login !!!"]);
    		}
    		else
    		{
    			dd('something wrong');
    		}
    		
    	}
    	catch(Exception $exception)
    	{
    		return $exception;
    	}

    }

}
