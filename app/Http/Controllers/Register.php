<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Register extends Controller
{
    public function show(Request $request)
    {
        if (!$request->session()->exists('users')) {
            return view("register", ["request" => $request]);
        }else{
            return redirect('/');
        }
    }

    public function control(Request $request)
    {
        if ($_POST['email'] && $_POST['password']) {
            $data = [
                'name' => $_POST["name"],
                'surname' => $_POST["surname"],
                'email' => $_POST["email"],
                'password' =>$_POST["password"]
            ];
            $users = DB::table('users')
                          ->insert($data);
        
            if ($users) {
                $users = DB::table('users')
                        ->where('email', $_POST["email"])
                        ->where('password', $_POST["password"])
                        ->first();
                session(['users' => $users->id]);
                return redirect("/");
            }else{
                $request->session()->flash('error.invalid', true);
                return redirect(route('get.login'));
            }
        }else{
            $request->session()->flash('error.null', true);
            return redirect(route('get.login'));
        }
    }
}
