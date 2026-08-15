<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Url extends Model
{
    //use HasFactory;

    public $timestamps = false;


    protected $fillable = [
    "user_id",
    "original_url",
    "short_code",
    "click_count",
    "is_active"
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];



    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function click_logs() {
        return $this->hasMany(ClickLog::class);
    }
}
