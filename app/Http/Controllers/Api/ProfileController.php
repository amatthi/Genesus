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
            'email'             => 'required|email|max:255|unique:users,email,' . $user->id,
            'biography'         => 'max:500',
            'career'            => 'max:500',
            'website'           => 'max:255',
            'brand_name'        => 'max:255',
            'brand_city'        => 'max:255',
            'brand_state'       => 'max:255',
            'brand_zip'         => 'max:255',
            'last_name'         => 'max:255',
            'instagram'         => 'max:255',
            'facebook'          => 'max:255',
            'twitter'           => 'max:255',
            'password'          => 'min:6|confirmed',
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

        $profile->last_name         = $request->input('last_name', '');
        $profile->instagram         = $request->input('instagram', '');
        $profile->facebook          = $request->input('facebook', '');
        $profile->twitter           = $request->input('twitter', '');
        $profile->website           = $request->input('website', '');
        $profile->brand_name        = $request->input('brand_name', '');
        $profile->career            = $request->input('career', '');
        $profile->brand_city        = $request->input('brand_city', '');
        $profile->brand_state       = $request->input('brand_state', '');
        $profile->brand_zip         = $request->input('brand_zip', '');
        $profile->biography         = $request->input('biography', '');
        $profile->save();

        $user->email = $request->input('email');
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return $user;
    }

    public function getPayment()
    {
        $user = Auth::user();
        if ($user) {
            $user->makeVisible(['card_brand', 'card_last_four']);
        }
        return [
            'user' => $user,
        ];
    }
}
