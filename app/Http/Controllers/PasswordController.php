<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        //verify email
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        // get user information
        $user = User::where('email', $email)->first();

        //check is exist user
        if(is_null($user)){
            session()->flash('danger', 'email is not register or wrong');
            return redirect()->back()->withInput();
        }

        //generate Token
        $token = hash_hmac('sha256', Str::random(40), config('app.key'));

        //save email and token
        DB::table('password_reset_tokens')->updateOrInsert(['email' => $email],
            [
                'email' => $email,
                'token' => Hash::make($token),
                'created_at'=>new Carbon,
            ]
        );

        //send token to user
        Mail::send('emails.reset_link', compact('token'), function($message) use ($email){
            $message->to($email)->subject('forget password');
        });

        session()->flash('success', 'reset you password is ok, please check you email');
        return redirect()->back();
    }

    public function reset()
    {
        
    }
}
