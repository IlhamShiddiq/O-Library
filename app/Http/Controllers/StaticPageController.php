<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function guide()
    {
        return view('librarian/guide');
    }

    public function selecting()
    {
        $role = auth()->user()->role;
        if($role == 'Pustakawan')
        {
            return redirect('/dashboard')->with('success', 'Selamat Datang '.auth()->user()->name);
        }
        else if($role == 'Admin')
        {
            return redirect('/dashboard')->with('success', 'Selamat Datang '.auth()->user()->name);
        }

        return redirect('/book');
        
    }
}
