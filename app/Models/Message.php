<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Searchable;

class Message extends Model 
{
    use Searchable;
    protected $fillable = ['stream_id', 'user_id', 'body'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    
    
}
