<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Leaderboard', ['users' => User::all()->toArray()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'userId' => 'required|exists:users,id',
            'points' => 'required|integer',
        ]);

        $user = User::find($data['userId']);
        $user->points = $data['points'];
        $user->save();

        return redirect()->back()->with('success', 'Points updated successfully');
    }
}
