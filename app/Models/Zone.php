<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'domain', 'file', 'name_server', 'email',
        'refresh', 'retry', 'expire', 'minimum', 'ttl'
    ];

    public function records()
    {
        return $this->hasMany(Record::class, 'zone_id');
    }
}
