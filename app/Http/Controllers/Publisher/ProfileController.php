<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function edit()
    {
        $user = Auth::user();
        return view('publisher.profile.edit', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'institution' => 'nullable',
            'bio' => 'nullable',
            'photo' => 'nullable|image|max:2048'
        ]);

        $data = $request->only([
            'name',
            'email',
            'institution',
            'bio'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile','public');
            $data['photo'] = $path;
        }

        $user->update($data);
        return back()->with('success','Profil berhasil diperbarui');
    }

}