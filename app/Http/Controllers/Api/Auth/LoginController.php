<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Trait\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    use ApiTrait;
    public function login(LoginRequest $request){

        $user = User::where([
            'email' => $request->email,
        ])->first();

        if( $user && Hash::check($request->password, $user->password) ){
            $token=$user->createToken('API TOKEN')->plainTextToken;


            return $this->apiResponse(message: __('successfully registered'),data:[
                "token" =>$token,
                "user" =>UserResource::make($user),

                ]
        );
        }



            return $this->apiResponse(message: __('These credentials do not match our records') );


    }
}
