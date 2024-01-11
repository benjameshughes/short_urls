<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Url extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'id',
        'uuid',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user that owns the url.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Cast attributes to native types.
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'uuid' => 'string',
        'url' => 'string',
        'short_url' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
