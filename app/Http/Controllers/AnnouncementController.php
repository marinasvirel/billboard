<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function show(Announcement $announcement)
    {
        $announcement->load('images');
        return view('announcement.show', compact('announcement'));
    }

    public function create()
    {
        return view('announcement.create');
    }
}
