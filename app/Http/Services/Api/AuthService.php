<?php

namespace App\Http\Services\Api;
use App\Models\User;
use App\Http\Requests\Api\Auth\SignInRequest;
use App\Http\Requests\Api\Auth\SignUpRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class AuthService
{

    public function register(SignUpRequest $request)
    {
        try
        {
            $data = $request->only('name',  'email');
            $data = array_merge($data, ["password" => Hash::make($request->password)]);
            $user = User::create($data);
            $user->token = $user->createToken('myapptoken')->plainTextToken;
            $user_data = new UserResource($user);
            return response($user_data, 200);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return $e->message();
        }
    }

    public function login(SignInRequest $request)
    {

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
            $user->token = $user->createToken($request->email)->plainTextToken;
            $user_data = new UserResource($user);
            return response($user_data, 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 404);
    }


    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logout successfully'],200);
    }

}
