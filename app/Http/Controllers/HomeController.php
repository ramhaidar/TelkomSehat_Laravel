<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home ( Request $request )
    {
        $user = Auth::user ();
        if ( $user )
        {
            return view ( view: 'index', data: [ 'users' => $user ], );
        }
        return view ( view: 'index' );
    }
}