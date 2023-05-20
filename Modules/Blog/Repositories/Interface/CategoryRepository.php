<?php 
namespace Modules\Blog\Repositories\Interface;
use Modules\Blog\Entities\Category;
use App\TestRepo\Interface\ParentRepositorty;
use Modules\Blog\Repositories\CategoryRepositoryInterface;


class CategoryRepository extends ParentRepositorty implements CategoryRepositoryInterface{
    
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
        // parent::__construct($model);
    }
   
}

