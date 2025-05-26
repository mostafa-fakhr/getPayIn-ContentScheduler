<?php

namespace App\Repositories;

use App\Constants\MethodParameter;
use App\Constants\Pagination;
use App\Enums\PostPlatformStatus;
use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostPlatform;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PostRepository
{
    public function createPost($user, $title, $content, $imageUrl = null, $scheduledTime = null, $status = null, $platforms = null)
    {
        $post = Post::create([
            'title' => $title,
            'content' => $content,
            'image_url' => $imageUrl,
            'scheduled_time' => $scheduledTime,
            'status' => $status,
            'user_id' => $user->id,
        ]);

        if ($platforms && is_array($platforms)) {
            $post->platforms()->attach($platforms);
        }

        return $post;
    }

    public function getUserPosts($userId, $status = null, $scheduledTime = null, $createdAt = null, $perPage = Pagination::PER_PAGE)
    {
        $query = Post::with('platforms')
            ->where('user_id', $userId);

        if ($status) {
            $query->where('status', $status);
        }

        if ($scheduledTime) {
            $query->whereDate('scheduled_time', $scheduledTime);
        }

        if ($createdAt) {
            $query->whereDate('scheduled_time', $createdAt);
        }

        return $query->orderBy('scheduled_time', 'desc')->paginate($perPage);
    }


    public function getDueScheduledPosts(Carbon $now)
    {
        return Post::where('status', PostStatus::Scheduled)
            ->where('scheduled_time', '<=', $now)
            ->get();
    }


    public function updatePostPlatformsByPostId($postId, $postPlaformStatus = PostPlatformStatus::Pending)
    {
        $query = PostPlatform::where('post_id', $postId);
        if ($postPlaformStatus) {
            $query->update(['platform_status' => $postPlaformStatus]);
        }
        return $query;
    }

    public function getPostById($postId)
    {
        return Post::find($postId);
    }

    public function updateScheduledPost($postId, $optionsArr)
    {
        $post = Post::find($postId);
        if (isset($optionsArr[MethodParameter::TITLE])) {
            $post->title = $optionsArr[MethodParameter::TITLE];
        }
        if (isset($optionsArr[MethodParameter::CONTENT])) {
            $post->content = $optionsArr[MethodParameter::CONTENT];
        }
        if (isset($optionsArr[MethodParameter::IMAGE_URL])) {
            $post->image_url = $optionsArr[MethodParameter::IMAGE_URL];
        }
        if (isset($optionsArr[MethodParameter::SCHEDULED_TIME])) {
            $post->scheduled_time = $optionsArr[MethodParameter::SCHEDULED_TIME];
        }
        if (isset($optionsArr[MethodParameter::STATUS])) {
            $post->status = $optionsArr[MethodParameter::STATUS];

            if ($optionsArr[MethodParameter::STATUS] === PostStatus::Published) {
                $platformIds = $post->platforms()->pluck('platforms.id')->toArray();

                if (!empty($platformIds)) {
                    $post->platforms()->updateExistingPivot($platformIds, [
                        'platform_status' => PostPlatformStatus::Posted,
                    ]);
                }
            }
        }
        $post->save();

        if (!empty($optionsArr[MethodParameter::PLATFORMS]) && is_array($optionsArr[MethodParameter::PLATFORMS])) {
            $post->platforms()->syncWithPivotValues($optionsArr[MethodParameter::PLATFORMS], [
                'platform_status' => PostPlatformStatus::Pending
            ]);
        }

        return $post->fresh('platforms');
    }
    public function deletePost($postId)
    {
        $post = Post::find($postId);
        $post->platforms()->updateExistingPivot(
            $post->platforms->pluck('id')->toArray(),
            ['deleted_at' => now()]
        );
        $post->delete();
        return $post;
    }
}
