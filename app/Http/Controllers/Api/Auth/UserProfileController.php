<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Trait\ApiTrait;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    use ApiTrait;
    public function userProfile(){
        $user=auth()->user();
        $user->load(['tweets']); //for eager loading
        return $this->apiResponse(data:UserResource::make($user));
    }
}
