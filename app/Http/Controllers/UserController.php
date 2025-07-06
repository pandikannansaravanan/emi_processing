<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if(!$_POST) {
            return view('login');
        }else {
            // dd($request->all());

            $rule = [
                'username' => 'required',
                'password' => ['required','min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).+$/'],
            ];
            $messages = [
                'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
            ];
            $validator = Validator::make($request->all(), $rule, $messages);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $check = Auth::attempt(['name' => $request->username, 'password' => $request->password]);
            if ($check) {
                // Redirect to loans page or wherever you want after login
                return redirect()->route('loans');
            } else {
                return back()->withErrors(['invalid_credentials' =>'Invalid credentials'])->withInput();
            }
        }


    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
