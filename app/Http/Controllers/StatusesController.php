<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class StatusesController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'context' => 'required|max:140',
        ]);

        Auth::user()->statuses()->create([
            'context' => $request['context']
        ]);

        session()->flash('success', '发布成功！');
        return redirect()->back();
    }

    public function destroy()
    {

    }
}
