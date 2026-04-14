<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'path',
        'full_url',
        'query_string',
        'ip_address',
        'user_agent',
        'device_type',
        'device_model',
        'browser',
        'os',
        'is_bot',
        'referer',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'country',
        'region',
        'city',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
        'is_bot' => 'boolean',
    ];
}
