<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

class ProfileController extends Controller
{
    public function edit()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        return Livewire::mount(\App\Livewire\Auth\ProfileEdit::class);
    }
}
