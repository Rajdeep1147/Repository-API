<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasTags;
    use HasFactory;

    protected $tagTypes = [
        'topic' => Tag::class,
        'genre' => Tag::class,
    ];
    
    protected $fillable = [ 
        'title_name', 
        'content' 
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
