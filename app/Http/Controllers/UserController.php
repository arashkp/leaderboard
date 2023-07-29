<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

        return redirect()->route('index')->with('success', 'User update successfully');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'age' => 'required|integer|min:0',
            'address' => 'required|string|max:255',
            'point' => 'required|integer|min:0',
        ]);

        $user = User::create($validatedData);

        return redirect()->route('index')->with('success', 'User added successfully');
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return redirect()->route('index')->with('success', 'User removed successfully');
    }
    
}
