<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        User::create($data);
        return redirect(route('home'))->with('message', 'Регистрация прошла успешно');
    }

    public function login()
    {
        return view('user.login');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
