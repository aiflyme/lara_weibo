<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
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

        if(auth::attempt($credentials, $request->has('remember'))){
            session()->flash('success', $request->name .' Welcome come back！');
            $fallback = route('user.show', Auth::user());
            return redirect()->intended($fallback);
        }else{
            session()->flash('danger', 'sorry, your email or password are not right!');
            return redirect()->back()->withInput();

        }

        return;
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', 'You have logout！');
        return redirect('login');
    }
}
