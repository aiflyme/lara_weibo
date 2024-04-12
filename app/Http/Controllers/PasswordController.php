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


    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        return view('auth.passwords.reset', compact('token'));
    }

    public function reset(Request $request)
    {
git
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $email = $request->email;
        $token = $request->token;

        // 找回密码链接的有效时间
        $expires = 60 * 10;

        // get user information
        $user = User::where('email', $email)->first();

        //check is exist user
        if(is_null($user)){
            session()->flash('danger', 'email is not register or wrong');
            return redirect()->back()->withInput();
        }

        //get the reset record from DB
        $record = (array)DB::table('password_reset_tokens')->where('email' ,$email)->first();

        //find record
        if($record){
            //check date
            if(Carbon::parse($record['created_at'])->addSecond($expires)->isPast()){
                session()->flash('danger', '链接已过期，请重新尝试');
                return redirect()->back();
            }
            //check the token is right
            if(! Hash::check($token, $record['token'])){
                session()->flash('danger', '令牌错误');
                return redirect()->back();
            }

            //update user password
            $user->update(['password' => bcrypt($request->password)]);
            session()->flash('success', 'update you password success');
            return redirect()->route('login');

        }

        // 6. 记录不存在
        session()->flash('danger', '未找到重置记录');
        return redirect()->back();
    }
}
