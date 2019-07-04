<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }


    //
    public function index()
    {
        return view('welcome');
    }

    public function create()
    {

        //Checking For The Values Entered
        $this->validate(request(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        //Attemot to authenticate User
        if (!auth()->attempt(request(['email', 'password']))) {
            return back()->withErrors([
                'message' => 'Invalid login credentials, try again '
            ]);
        }

        return redirect("/patients");


    }


    public function destroy()
    {
        auth()->logout();
        return redirect("/");

    }
}
