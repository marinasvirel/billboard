<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function ban(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('message', 'Вы не можете забанить самого себя!');
        }
        $user->update(['is_banned' => true]);
        return back()->with('message', "Пользователь {$user->name} заблокирован.");
    }

    public function unban(User $user)
    {
        $user->update(['is_banned' => false]);
        return back()->with('message', "Пользователь {$user->name} разблокирован.");
    }

    public function announcementsView()
    {
        return view('admin.announcements');
    }
}
