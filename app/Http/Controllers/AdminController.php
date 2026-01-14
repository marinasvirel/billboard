<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function bearersView()
    {
        return view('admin.bearers');
    }

        public function announcementsView()
    {
        return view('admin.announcements');
    }
}
