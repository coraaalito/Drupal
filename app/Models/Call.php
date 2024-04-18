<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Call extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
  
    protected $fillable = [
        'title',
        'content',
        'emails',
        'initial_date',
        'end_date',
        'initial_register',
        'end_register',
        'active',      
    ];

    protected $casts = [
        'emails' => 'array',
    ];


    //-------------------------------------------------------------------------
    //                           RELATIONSHIPS
    //-------------------------------------------------------------------------
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }


    //-------------------------------------------------------------------------
    //                           MEDIA LIBRARY
    //-------------------------------------------------------------------------
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }   
    
}


