<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        event(new Registered($user));
        Auth::login($user);
        return redirect(route('verification.notice'));
    }

    public function login()
    {
        return view('user.login');
    }

    public function authenticate(UserLoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('announcement/create');
        }
        return back()->withErrors([
            'email' => 'Предоставленные учетные данные не соответствуют нашим записям.',
        ])->onlyInput('email');
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
