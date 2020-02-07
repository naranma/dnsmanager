<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordType extends Model
{
    public $timestamps = false;  // Disable "updated_at", "created_at"

    protected $fillable = [
        'domain', 'file', 'name_server', 'email', 'serial', 'refresh', 'retry', 'expire', 'minimum', 'ttl'
    ];

    public function records()
    {
        return $this->hasMany(Record::class, 'record_type_id');

    }
}
