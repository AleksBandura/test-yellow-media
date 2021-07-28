<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        // Lumen suck
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $pass = $request->input('password');

        $user = User::where('email', $email)->first();

        if (Hash::check($pass, $user->password)) {
            $apikey = base64_decode(uniqid('', true));
            User::where('email', $email)->update(['api_key' => $apikey]);;
            return response()->json(['status' => 'success', 'api_key' => $apikey]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|min:3|max:32',
            'last_name' => 'required|string|min:3|max:32',
            'email' => 'required|email',
            'phone' => 'string|min:3',
            'password' => 'required|min:8'
        ]);

        $user = new User([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => Hash::make($request->input('password')),
        ]);

        $user->saveOrFail();

        return response()->json(['status' => 'success']);
    }

    public function recoverPassword($id)
    {
        // to many non-paid work
    }
}
