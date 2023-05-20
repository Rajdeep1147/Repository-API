<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Tags\HasTags;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Student extends Model
{
    use HasFactory,HasTags,HasRoles;
    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'address',
        'contact',
        'pincode',
];

public const STATUS = 1;

public function post() :HasMany 
{
         return $this->hasMany(Post::class,'student_id');
}

}
