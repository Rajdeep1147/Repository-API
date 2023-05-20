<?php 
namespace App\TestRepo\Interface;
use App\Models\Student;
use App\TestRepo\MyStudentRepositoryInterface;


class MyStudentRepository extends ParentRepositorty implements MyStudentRepositoryInterface{
    protected $model;

    public function __construct(Student $model)
    {
        $this->model =$model;
    }
   
}
