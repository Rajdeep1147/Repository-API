<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model
{
    use HasFactory;

        protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'address',
        'contact',
        'pincode',
        'department',
        'google_id'
    ];
    
    protected static function newFactory()
    {
        //  return \Modules\Blog\Database\factories\CategoryFactory::new();
    }
}
