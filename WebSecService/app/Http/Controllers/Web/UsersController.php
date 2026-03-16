<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    // ─── LIST with search/filter ───────────────────────────────────────────
    public function list(Request $request)
    {
        $query = User::select('users.*');

        $query->when($request->keywords,
            fn($q) => $q->where(function($q) use ($request) {
                $q->where('name',     'like', "%$request->keywords%")
                  ->orWhere('username','like', "%$request->keywords%")
                  ->orWhere('email',   'like', "%$request->keywords%");
            })
        );

        $users = $query->get();

        return view('users.list', compact('users'));
    }

    // ─── SHOW ADD / EDIT FORM ──────────────────────────────────────────────
    public function edit(Request $request, User $user = null)
    {
        $user = $user ?? new User();
        return view('users.edit', compact('user'));
    }

    // ─── SAVE (create or update) ───────────────────────────────────────────
    public function save(Request $request, User $user = null)
    {
        $user = $user ?? new User();

        $user->name     = $request->name;
        $user->username = $request->username;
        $user->email    = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users_list');
    }

    // ─── DELETE ────────────────────────────────────────────────────────────
    public function delete(Request $request, User $user)
    {
        $user->delete();
        return redirect()->route('users_list');
    }
}
