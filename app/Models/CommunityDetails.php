<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(["user_id", "community_name", "bio_community","created_at"])]
class CommunityDetails extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
