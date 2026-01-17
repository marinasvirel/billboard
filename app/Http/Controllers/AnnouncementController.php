<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function show($id)
    {
        $announcement = Announcement::find($id);
        return view('announcement.show', compact('announcement'));
    }
}
