<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTweetRequest;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Trait\ApiTrait;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    use ApiTrait;
    public function store(StoreTweetRequest $request){

        return $this->apiResponse(message: __('tweet created successfully'),data:TweetResource::make(Tweet::create($request->validated())));

    }
}
