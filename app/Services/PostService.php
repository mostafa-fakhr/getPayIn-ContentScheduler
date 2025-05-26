<?php

namespace App\Services;

use App\Constants\Error;
use App\Constants\MethodParameter;
use App\Constants\Pagination;
use App\Constants\PostStatusConstants;
use App\Enums\PostPlatformStatus;
use App\Enums\PostStatus;
use App\Exceptions\AuthenticationException;
use App\Repositories\PostRepository;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;

class PostService
{
    protected PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function createPost($user, $title, $content, $imageUrl = null, $scheduledTime = null, $status = null, $platforms = null)
    {
        if (is_null($status)) {
            $status = PostStatus::Draft;
        }
        $post = $this->postRepository->createPost($user, $title, $content, $imageUrl, $scheduledTime, $status, $platforms);
        return $post;
    }

    public function getUserPosts($user, $status = null, $scheduledTime = null, $createdAt = null, $perPage = Pagination::PER_PAGE)
    {
        return $this->postRepository->getUserPosts($user->id, $status, $scheduledTime, $createdAt, $perPage);
    }

    public function getDueScheduledPosts(Carbon $now)
    {
        return $this->postRepository->getDueScheduledPosts($now);
    }


    public function updatePostPlatformsByPostId($postId, $postPlaformStatus = PostPlatformStatus::Pending)
    {
        return $this->postRepository->updatePostPlatformsByPostId($postId, $postPlaformStatus);
    }

    public function updateScheduledPost($postId, $optionsArr)
    {
        $post = $this->postRepository->getPostById($postId);
        $this->validatePostExists($postId);
        if ($post->status == PostStatusConstants::PUBLISHED) {
            throw new AuthorizationException(Error::UNAUTHORIZED_ACCESS);
        }
        $hasPublishedPlatform = $post->platforms()->wherePivot('platform_status', PostPlatformStatus::Posted)->exists();
        if ($hasPublishedPlatform) {
            throw new AuthorizationException(Error::UNAUTHORIZED_ACCESS);
        }
        return $this->postRepository->updateScheduledPost($postId, $optionsArr);
    }

    public function deletePost($postId)
    {
        $this->validatePostExists($postId);
        return $this->postRepository->deletePost($postId);
    }

    public function validatePostExists($postId)
    {
        $post = $this->postRepository->getPostById($postId);
        if (is_null($post)) {
            throw new AuthorizationException(Error::POST_NOT_FOUND);
        }
    }
}
