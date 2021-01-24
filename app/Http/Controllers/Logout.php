<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Logout extends Controller
{
    public function run(Request $request)
    {
        $request->session()->pull('users', 'default');
        return redirect("/login");
    }
}
