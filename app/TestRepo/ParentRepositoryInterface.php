<?php 
namespace App\TestRepo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


Interface ParentRepositoryInterface
{
    public function all(array $columns=['*'],array $relation =[]);

    public function create(array $data);

    public function update(int $id,array $value);

    public function deleteById(int $id);

    public function findById(int $id,array $columns=['*'],array $relations=[],array $appends=[]);

    public function search($search_value,array $columns=['*'],array $relations=[]);

    public function filter($filter_value,$search,array $columns=['*'],array $relations=[]);
    
}