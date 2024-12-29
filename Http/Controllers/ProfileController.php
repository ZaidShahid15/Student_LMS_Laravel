<?php

namespace App\Http\Controllers;

use App\Http\Requests\profileRequest;
use App\Models\profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index($id)
    {
        $data['profile'] = Profile::with('user')->where('user_id', $id)->first();



        return view('profile', $data);
    }

    public function setUrl(profileRequest $req)
    {
        $data = Profile::where('user_id', Auth::user()->id)->first();

        if ($data) {
            $data->update($req->all());
            $message = 'Profile updated successfully';
        } else {
            $data = Profile::create($req->all());
            $data->user_id = Auth::user()->id;
            $message = 'Profile created successfully';
        }

        if ($req->hasFile('pic')) {
            $image = time() . '.' . $req->pic->extension();
            $req->pic->move(public_path('images'), $image);
            $data->pic = $image;
        }

        $data->save();

        return response()->json([
            'success' => 'success',
            'message' => $message,
            'data' => $data
        ]);
    }
}
