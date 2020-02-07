<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'zone_id', 'record_type_id', 'record_group_id', 'name', 'value', 'ttl', 'priority', 'active'
    ];

    public function type()
    {
    	return $this->belongsTo(RecordType::class, 'record_type_id');
    }

    public function group()
    {
    	return $this->belongsTo(RecordGroup::class, 'record_group_id');
    }
}
