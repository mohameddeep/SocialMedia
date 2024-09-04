<?php

namespace App\Http\Controllers\Api;

use App\Events\FollowingUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFollowUserRequest;
use App\Http\Resources\TweetResource;
use App\Http\Services\ApiNotificationService;
use App\Jobs\SendFollowingMessageJob;
use App\Models\Tweet;
use App\Models\User;
use App\Trait\ApiTrait;
use Illuminate\Http\Request;

class FollowController extends Controller
{
use ApiTrait;



    public function followUser(StoreFollowUserRequest $request){
        $user=auth()->user();

        if($user->id == $request->following_id){
            return  $this->apiResponse(message:__("user can not follow yourself"));
        }

        if($user->following()->where("following_id",$request->following_id)->exists()){
            return  $this->apiResponse(message:__("user can not follow another user twice"));
        }
        $user->following()->attach($request->following_id);


        //send mail notification
        $followinguser=User::where("id",$request->following_id)->first();

        SendFollowingMessageJob::dispatch($followinguser,$user);


        // use firebase notification i test it and it works
        $body=auth()->user()->name. "want to follow you";
        ApiNotificationService::apiNotification($followinguser->fcm, $body,"send realtime notification");


        // using socket io i tried to do it but i didn,t test it
        broadcast(new FollowingUser( $user,$followinguser));
        return  $this->apiResponse(message:__("user follows successfully"));
    }


    public function getFollingUserTweet(){


        $followingUsers = auth()->user()->following()->pluck('following_id');

        $tweets = Tweet::whereIn('user_id', $followingUsers)->with('user')->latest()->paginate(20);

        return TweetResource::collection($tweets);

    }


}
