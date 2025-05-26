<?php

namespace App\Http\Controllers;

use App\Constants\MethodParameter;
use App\Constants\Pagination;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\DeletePostRequest;
use App\Http\Requests\GetPostsRequest;
use App\Http\Requests\GetUserByIdRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateScheduledPostRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function createPost(CreatePostRequest $request)
    {
        $data = $this->postService->createPost($request->user(), $request->input('title'), $request->input('content'), $request->input('image_url', null), $request->input('scheduled_time', null), $request->input('status', null), $request->input('platforms', null));

        return response()->json($data, 201);
    }

    public function getUserPosts(GetPostsRequest $request)
    {
        $posts = $this->postService->getUserPosts(
            auth()->user(),
            $request->input('status', null),
            $request->input('scheduled_time', null),
            $request->input('created_at', null),
            $request->input('per_page', Pagination::PER_PAGE)
        );

        return response()->json($posts);
    }


    public function updateScheduledPost(UpdateScheduledPostRequest $request, $postId)
    {
        $optionsArr = [
            MethodParameter::TITLE => $request->input('title', null),
            MethodParameter::CONTENT => $request->input('content', null),
            MethodParameter::IMAGE_URL => $request->input('image_url', null),
            MethodParameter::SCHEDULED_TIME => $request->input('scheduled_time', null),
            MethodParameter::STATUS => $request->input('status', null),
            MethodParameter::PLATFORMS => $request->input('platforms', null),
        ];
        $data = $this->postService->updateScheduledPost($postId, $optionsArr);
        return response()->json($data, 200);
    }

    public function deletePost(DeletePostRequest $request, $postId)
    {
        $this->postService->deletePost($postId);
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
