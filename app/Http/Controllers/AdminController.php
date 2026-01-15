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

    public function bearersEdit($id)
    {
        $bearer = User::findOrFail($id);
        return view('admin.bearers-update', compact('bearer'));
    }

    public function bearersUpdate(Request $request, $id)
    {
        $bearer = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'min:2',
            'email' => 'min:2',
            'role' => 'min:2',
        ]);
        $bearer->update($validated);
        return redirect()->route('admin')->with('message', 'Обновлено!');
    }

    public function announcementsView()
    {
        return view('admin.announcements');
    }
}
