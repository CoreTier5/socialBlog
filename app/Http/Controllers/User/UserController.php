<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Image;
use Alert;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Exception;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //dd($request);
        try
        {
            $user               = new User();
            $user->firstName    = $request->firstName;
            $user->lastName     = $request->lastName;
            $user->email        = $request->email;
            $user->password     = Hash::make($request->password);
            if($request->hasfile('photo'))
            { 
                $photo = $request->file('photo');
                $photoname =time().'.'.$photo->getClientOriginalExtension();
                Image::make($photo)->save(public_path('images/profilePhotos/' . $photoname));
                $user->profilePhoto = $photoname;
            }
            $user->save();
            return redirect()->route('user.home')->with(['success' => true, 'message' => "Successfully Registered."]);
        }
        catch(\Exception $exception)
        {
           //return redirect()->route('user.home')->with(['success' => false, 'message' => $exception]);
           return $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
     * Login view
     */
    public function login()
    {
        return view('users.login');
    }

    /*
     * User Login Authenticate
     */
    public function authenticate(LoginRequest $request)
    {
        try
        {
            $credentials = $request->only('email', 'password'); 
            if(Auth::attempt($credentials))
            {
            
                return redirect()->route('all.post');
            }
            else 
            {
                return redirect()->route('user.login')->with(['success' => false, 'message' => "Invalid credentials "]);    
            }
        }

        catch(Exception $exception)
        {
            return $exception;
        }
    }

    /*
     * Logout function
     */
    public function logout()
    {
        try
            {
                //Alert::message('test');
                Auth::logout();
                 //alert()->success('You have been logged out.', 'Good bye!');
                    return redirect('/home');
            }
        catch(Exception $exception)
        {
            return $exception;
        }
    }
}
