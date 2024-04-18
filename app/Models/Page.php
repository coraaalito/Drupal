<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'call_id',
    ];

    //-------------------------------------------------------------------------
    //                           RELATIONSHIPS
    //-------------------------------------------------------------------------
    public function call()
    {
        return $this->belongsTo(Call::class);
    }

}
