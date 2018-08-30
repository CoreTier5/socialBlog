<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName'         =   'required',
            'lastName'          =   'required',
            'email'             =   'required|unique:users',
            'password'          =   'required|min:8',
            'confirmPassword'   =   'required|same:password'
        ];
    }
}
 public function rules()
    {
        // return [
        //     'firstName'         =   'required',
        //     'lastName'          =   'required',
        //     'email'             =   'required|unique:users',
        //     'password'          =   'required|min:8',
        //     'confirmPassword'   =   'required|same:password'
        // ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    // public function messages()
    // {
    //     return [
    //         'firstName.required'        => 'Please provide a first name',
    //         'lastName.required'         => 'Please provide a last name',
    //         'email.required'            => 'Please provide a email address',
    //         'email.unique'              => 'This email is already taken',
    //         'password.required'         => 'Please provide a password',
    //         'password.min'              => 'Password should be minimum 8 character long',
    //         'confirmPassword.required'  => 'Please provide a proper password',
    //         'confirmPassword.same'      => 'Password and confirm password should be same'
    //     ];
    // }

    
}
