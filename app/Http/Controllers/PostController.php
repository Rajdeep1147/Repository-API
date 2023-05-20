<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Student;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return $posts;
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $tags = explode(",", $request->tags);
        $post = Post::create($input);
        $post->tag($tags);
        return back()->with('success', 'Post added to database.');
    }

    public function attach()
    {
        $post = Post::find(4);
        $post->attachTags(['recent', 'new', 'old']);
        $tags = $post->tags;
        return $tags;
    }

    public function detach()
    {
        $post = Student::find(51);
        $post->detachTags(['tag1', 'tag2']);
        $tags = $post->tags;
        return $tags;
    }

    public function getRelation()
    {
        $post = Post::find(3);
        $tag = Tag::find(1);
        $h = $post->tags()->attach($tag);
        return $post->tags;
    }

    public function eluqu()
    {

        // return "hello";
        // $posts = Post::whereDoesntHave('comments', function (Builder $query) {
        //     $query->where('title', 'like', 'code%');
        // })->get();

        // return $posts;

    }

    public function collectInfo()
    {
        // Filter Method
        //   return collect([1,2,3,4,5,[]])->filter(function($value){
        //         return $value;
        //   });

        // search Method

        // $names = collect(['Alex', 'John', 'Jason', 'Martyn', 'Hanlin']);

        // return $names->search('Martyn');


        // each method
        $student = Student::all();
        // return $student->each(function($student){

        // });

        // map method
        // return $student->map(function($student){
        //     if($student->status==4){
        //         $student->email_confirmed=1;
        //     }
        //     return $student;
        // });

        // min function in laravel

        // $collection = collect([
        //     ['name' => 'John', 'age' => 25],
        //     ['name' => 'Jane', 'age' => 30],
        //     ['name' => 'Bob', 'age' => 20]
        // ]);

        // $minAge = $collection->min('age');
        // return $minAge;

        //    max function in laravel

        // $collection = collect([
        //     ['name' => 'John', 'age' => 25],
        //     ['name' => 'Jane', 'age' => 30],
        //     ['name' => 'Bob', 'age' => 20]
        // ]);

        // $minAge = $collection->max('age');
        // return $minAge;

        //    Avg function in laravel
        $collection = collect([10, 20, 30, 44, 50]);
        return $collection->avg();
    }
}
