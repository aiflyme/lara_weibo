<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SessionController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6'
        ]);

        if(auth::attempt($credentials)){
            session()->flash('success', $request->name .' Welcome come back！');
            return redirect()->route('user.show', [Auth::user()]);

        }else{
            session()->flash('danger', 'sorry, your email or password are not right!');
            return redirect()->back()->withInput();

        }

        return;
    }

    public function destroy()
    {

    }
}
