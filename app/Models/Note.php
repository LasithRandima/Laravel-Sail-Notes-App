<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    //to return uuid instead od id field on the model

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
