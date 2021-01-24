<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Note extends Controller
{
    public function show(Request $request, $slug)
    {
        $note = DB::table('notes')
                ->where('author', session('users'))
                ->where('slug', $slug)
                ->first();

        return view("NoteList", ["request" => $request, "note" => $note]);
    }

    public function new(Request $request)
    {
        return view("NoteAdd", ["request" => $request]);
    }
    
    public function delete(Request $request)
    {
        $delete = DB::table('notes')->where('id', $_POST['id'])->delete();
        if ($delete) {
            return "success";
        }else{
            return "null";
        }
        
    }

    public function add(Request $request)
    {
        if ($_POST['title'] && $_POST['note']) {
            $notes = DB::table('notes')->insert([
                'title' => $_POST['title'],
                'slug' => Str::slug($_POST['title'], '-'),
                'note' => $_POST['note'],
                'author' => session('users')
            ]);
        
            if ($notes) {
                return redirect("/");
            }else{
                $request->session()->flash('error.error', true);
                if ($_POST['title']) {
                    $request->session()->flash('title', $_POST['title']);
                }
                if ($_POST['note']) {
                    $request->session()->flash('note', $_POST['note']);
                }
                return redirect(route('get.new.note'));
            }
        }else{
            $request->session()->flash('error.null', true);
            if ($_POST['title']) {
                $request->session()->flash('title', $_POST['title']);
            }
            if ($_POST['note']) {
                $request->session()->flash('note', $_POST['note']);
            }
            return redirect(route('get.new.note'));
        }
    }

    public function update(Request $request)
    {
        if ($_POST['title'] && $_POST['note']) {
            $notes = DB::table('notes')
                        ->where('id', $_POST['id'])
                        ->update([
                            'title' => $_POST['title'],
                            'slug' => Str::slug($_POST['title'], '-'),
                            'note' => $_POST['note']
                        ]);
        
            if ($notes) {
                return redirect(route('get.list.note', ['slug' => $_POST['slug']]));
            }else{
                $request->session()->flash('error.error', true);
                if ($_POST['title']) {
                    $request->session()->flash('title', $_POST['title']);
                }
                if ($_POST['note']) {
                    $request->session()->flash('note', $_POST['note']);
                }
                return redirect(route('get.list.note', ['slug' => $_POST['slug']]));
            }
        }else{
            $request->session()->flash('error.null', true);
            if ($_POST['title']) {
                $request->session()->flash('title', $_POST['title']);
            }
            if ($_POST['note']) {
                $request->session()->flash('note', $_POST['note']);
            }
            return redirect(route('get.list.note', ['slug' => $_POST['slug']]));
        }
    }
}
