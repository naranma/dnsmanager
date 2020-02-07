<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordGroup extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function records()
    {
    	return $this->hasMany(Record::class, 'record_group_id');
    }
}
