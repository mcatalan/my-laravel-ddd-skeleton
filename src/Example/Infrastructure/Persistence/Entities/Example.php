<?php

namespace Src\Example\Infrastructure\Persistence\Entities;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'id' => 'integer',
    ];

    //
    // Example fields:
    //
    // id
    // title
    // description
    // created_at
    // updated_at
    //
}
