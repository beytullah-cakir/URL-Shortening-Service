<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClickLog extends Model
{

    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
      "url_id",
    "ip_address",
    "user_agent",
    "referer",
    "visited_at"
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];


    public function urls(): BelongsTo
    {
        return $this->belongsTo(Url::class);
    }
}
