<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class accountController extends Controller
{

    public function index()
    {
        $user = user::findOrFail(Auth::id());
        return view('Panel.account.index',compact('user'));
    }

    public function edit(string $id)
    {
        $user=user::findOrFail($id);
        return view('Panel.account.edit',compact('user','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'رمز عبور فعلی نادرست است.',
            ], 403);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        return response()->json([
            'message' => 'اطلاعات با موفقیت بروزرسانی شد.',
            'redirect' => route('Panel.account.index')
        ]);
    }

}
