<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function show(Announcement $announcement)
    {
        return view('announcement.show', compact('announcement'));
    }
}
