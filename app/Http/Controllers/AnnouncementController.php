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
        return view('announcement.show', compact('announcement'));
    }

    public function create()
    {
        return view('announcement.create');
    }

    public function store(Request $request)
    {
        dump($request->all());
    }

    // public function store(StoreAnnouncementRequest $request)
    // {
    //     $data = $request->validated();
    //     $slug = Str::slug($request->title);
    //     $originalSlug = $slug;
    //     $count = 1;
    //     while (Announcement::where('slug', $slug)->exists()) {
    //         $slug = $originalSlug . '-' . $count++;
    //     }

    //     $data['slug'] = $slug;


    //     Announcement::create($data);

    //     return redirect()->route('announcements.index');
    // }
}
