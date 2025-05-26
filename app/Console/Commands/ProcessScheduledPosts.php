<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Enums\PostStatus;
use App\Services\PostService;
use Carbon\Carbon;
use App\Enums\PostPlatformStatus;

class ProcessScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-scheduled-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process and publish scheduled posts';


    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        parent::__construct();
        $this->postService = $postService;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $this->info("Current time: $now");
        $posts = $this->postService->getDueScheduledPosts($now);

        foreach ($posts as $post) {
            Log::info("Publishing post ID {$post->id}: '{$post->title}'");

            $post->update(['status' => PostStatus::Published]);

            $this->postService->updatePostPlatformsByPostId($post->id, PostPlatformStatus::Posted);
        }


        $this->info("Processed {$posts->count()} scheduled posts.");
    }
}
