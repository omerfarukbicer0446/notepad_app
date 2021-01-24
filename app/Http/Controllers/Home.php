<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Home extends Controller
{
    public function show(Request $request)
    {
        if ($request->session()->exists('users')) {
            $notes = DB::table('notes')
                ->where('author', session('users'))
                ->orderByDesc('updated_at')
                ->get();

            return view("home", ["notes" => $notes]);
        }else{
            return redirect('/login');
        }
    }
}
