<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [
	'uses' => 'User\UserController@index',
	'as' => 'user.home'
]);


Route::middleware(['authorize'])->group(function () {

	//Login Route
	Route::get('/login',[
		'uses'	=>	'User\UserController@login',
		'as'	=>	'user.login'
	]);

	Route::get('/register', function (){
		return view('users.register');
	});

	Route::post('/registerNewUser','User\UserController@store');
	Route::post('/login','User\UserController@authenticate');

	//Reset Password view
	Route::get('/forgotUserPassword', function(){
		return view('users.forgotPassword');
	});

	//Create the token
	Route::post('/forgotPassword','User\PasswordResetController@index');

	//Link from the user mail
	Route::get('/resetPassword',[
		'uses'	=>	'User\PasswordResetController@reset',
		'as'	=>	'reset.password'
	]);

	//Create a new password for user
	Route::post('/newPasswordCreator','User\PasswordResetController@newPassword');

});

	
//Terms and condition page
Route::get('/terms',function(){
	return view('terms');
});

Route::get('/logout',[
	'uses' => 'User\UserController@logout',
	'as' => 'user.logout'
]);


Route::middleware(['unAuthorize'])->group( function () {

	// Posts routes

		//Display all posts
		Route::get('/allPost',[
			'uses' =>'Posts\PostController@index',
			'as' => 'all.post'
		]);

		//return Form view of creating a new post
		Route::get('/create',[
			'uses' =>'Posts\PostController@create',
			'as' => 'create.post'
		]);

		//store a new post
		Route::post('/createPost','Posts\PostController@store');

		//Edit the post
		Route::get('/edit/{post_id}','Posts\PostController@edit');

        //Edit the image
        Route::get('/editImage/{post_id}','Posts\PostController@editImage');
        //Edit the image Ajax
        Route::post('/uploadimage','Posts\PostController@editImageAjax');

		//Delete the post
		Route::get('delete/{id}' ,[
			'uses'=>'Posts\PostController@destroy',
			'as'=>'post.destroy'
		]);

		//Update the post
		Route::post('/update',[
			'uses'	=> 'Posts\PostController@update',
			'as'	=> 'update.post'
		]);

		//LikePost Route
		Route::get('/like/{post_id}','Posts\PostController@likePost');	

		//DisLikePost Route
		Route::get('/dislike/{post_id}','Posts\PostController@disLikePost');


	//Users Routes

		// View Profile Route
		Route::get('/view/{user_email}','User\ProfileController@viewProfile');
		
		// View Current User Profile Route
		Route::get('/view',[
			'uses'	=> 'User\ProfileController@viewCurrentUser',
			'as'	=> 'user.view'
		]);

		//Search Users and posts
		Route::post('/search','SearchController@search');
});
		

//Route::get('/api','Posts\PostController@api');
Route::get('/test', function () {
    return view('Test');
});