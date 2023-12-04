<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'code', 'description'];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
