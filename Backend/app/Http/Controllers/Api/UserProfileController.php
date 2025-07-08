<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        $user = $request->user();

        // ✅ Validate fields including optional image
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $user->id,
            'password'       => 'nullable|string|min:6|confirmed',
            'bio'            => 'nullable|string|max:1000',
            'profile_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ✅ added image validation
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        if (isset($data['bio'])) {
            $user->bio = $data['bio'];
        }

        // ✅ Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_images'), $filename);

            // Optional: delete old image if needed
            if ($user->profile_image && file_exists(public_path('uploads/profile_images/' . $user->profile_image))) {
                unlink(public_path('uploads/profile_images/' . $user->profile_image));
            }

            $user->profile_image = $filename;
        }

        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'user'    => $user
        ]);
    }
}
