<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function bearersView()
    {
        $users = User::all();
        return view('admin.bearers', compact('users'));
    }

        public function announcementsView()
    {
        return view('admin.announcements');
    }
}
