<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Team extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;


    protected $fillable = [
        'name',
        'filename',
        'category_id',
        'call_id',
        'url_video',
        'url_proyect',
    ];

    //-------------------------------------------------------------------------
    //                           RELATIONSHIPS
    //-------------------------------------------------------------------------
    public function call()
    {
        return $this->belongsTo(Call::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function member()
    {
        return $this->hasMany(Member::class);
    }

}
