<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
}
