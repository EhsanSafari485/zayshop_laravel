<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\editUserRequest;
use App\Http\Requests\auth\registerRequest;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=user::orderBy('id','desc')->get();
        return view('Panel.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Panel.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(registerRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return redirect()->route('Panel.users.index')->with('success','عملیات ثپت با موفقیت انجام شد');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=user::findOrFail($id);
        return view('Panel.users.edit',compact('user','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(editUserRequest $request, string $id)
    {
        $user = user::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->update();

        return redirect()->route('Panel.users.index')->with('success', 'عملیات ویرایش با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = user::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);

    }
    }
