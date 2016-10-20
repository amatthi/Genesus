<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Profile;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {

    }

    public function is_login()
    {
        $user = Auth::user();
        if ($user) {
            $user->profile;
        }
        return [
            'user' => $user,
        ];
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
            'biography' => 'max:500',
            'password'  => 'min:6|confirmed',
        ]);

        $profile = $user->profile;
        if (!$profile) {
            $profile          = new Profile();
            $profile->user_id = $user->id;
        }

        if ($request->input('photo')) {
            $img           = base64_decode(explode(',', $request->input('photo'))[1]);
            $img_info      = getimagesizefromstring($img);
            $img_type      = explode('/', $img_info['mime'])[1];
            $s3            = \Storage::disk('s3');
            $imageFileName = 'profile' . $user->id . '-' . time() . str_random(20) . '.' . $img_type;
            $filePath      = $imageFileName;
            $s3->put($filePath, $img, 'public');
            $profile->photo = $s3->url($filePath);
        }

        $profile->biography = ($request->input('biography')) ? $request->input('biography') : '';
        $profile->save();

        $user->email = $request->input('email');
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return $user;
    }
}
