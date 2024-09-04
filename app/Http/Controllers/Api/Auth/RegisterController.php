<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Trait\ApiTrait;
use App\Trait\UploadFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use ApiTrait,UploadFileTrait;
    public function register(RegisterRequest $request){
        // dd($request);
        $newUser = $request->validated();
        $newUser['password'] = Hash::make($request->password);

        // for image
        $image=null;
        if($request->hasFile('image')){
            $image = $this->uploadFile(User::Path,$request->file('image'));
        }

        $user = User::create(array_merge($newUser, [ "image"=> $image]));

        //create token
        $token =$user->createToken('API TOKEN')->plainTextToken;

        return $this->apiResponse(message: __('successfully registered'),data:[
            "token" =>$token,
            "user" =>UserResource::make($user),
            ]
    );
    }
}
