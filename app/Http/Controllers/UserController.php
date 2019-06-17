<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Connection;
use App\KidDiary;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function profile() {
        $user = Auth::user();
        $connection = Connection::where('user_id', $user->id)->first();
        $isConnected = $connection != null;
        $kdUser = null;
        $schools = [];
        if ($isConnected) {
            $kd = new KidDiary;
            $kdUser = $kd->getUserProfile($connection->access_token);
            $schools = [$kd->getSchools($connection->access_token)];
        }
        return view('profile', ['user' => $user, 'isConnected' => $isConnected, 'kiddiaryUser' => $kdUser, 'schools' => $schools]);
    }

    public function connect() {
        $kd = new KidDiary;
        return $kd->redirectAuthorize();
    }

    public function connectCallback(Request $request) {
        $kd = new KidDiary;
        $token = $kd->exchangeAccessToken($request->code);
        $connection = new Connection;
        $connection->user_id = Auth::user()->id;
        $connection->access_token = $token['access_token'];
        $connection->refresh_token = $token['refresh_token'];
        $connection->expires = $token['expires_in'];
        $connection->save();
        return redirect(route('profile'));
    }

    public function disconnect() {
        Connection::where('user_id', Auth::user()->id)->delete();
        return redirect(route('profile'));
    }
}
