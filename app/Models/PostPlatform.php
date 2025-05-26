<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostPlatform extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'post_platforms';

    protected $fillable = ['post_id', 'platform_id', 'platform_status'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
