<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $role = Auth::user()->role;
            if ($role == 'user') {
                return view('dashboard');
            } elseif ($role == 'admin') {
                return view('admin.index');
            } else {
                return redirect()->route('login');
            }
        }
    }
}
