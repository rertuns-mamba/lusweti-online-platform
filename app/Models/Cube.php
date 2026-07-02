<?php

namespace App\Models;

use App\Events\CubeUpdated;
use Illuminate\Database\Eloquent\Model;

class Cube extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::updated(function (Cube $cube) {
            CubeUpdated::dispatch($cube);
        });
    }
}