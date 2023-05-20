<?php 
namespace App\TestRepo\Interface;

use App\Models\Student;
use App\TestRepo\ParentRepositoryInterface;
use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Entities\Category;

class ParentRepositorty implements ParentRepositoryInterface{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model =$model;
    }

    public function all(array $columns=['*'],array $relation =[])
    {
        return $this->model->with($relation)->get($columns);
    }

    public function create(array $data)
    {
      
      DB::beginTransaction();
      try{
        $user = $this->model->create($data);
        DB::commit();
      }catch(\Exception $e){
        DB::rollBack();
        $user = null ;
      }
      if($user !=null){
        return response()->json(['message'=>"User Is Created Successfully"],200);
      }else{
        dd($e->getMessage());
        return response()->json(['message'=>"Internal Server Error"],500);
      }
    }

    public function findById(int $id,array $columns=['*'],array $relations=[],array $appends=[]){
        return $this->model->select($columns)->with($relations)->findOrFail($id)->append($appends);
    }

    public function update(int $id, array $payload)
    { 
        $model = $this->findById($id);
        $updated_data =  $model->update($payload);
        if(!$updated_data){
          return response()->json([
            "message"=>"Data is not updated",
            "status"=>0
          ],500);
        }else{
          return response()->json([
            "message"=>"Data is updated Successfully",
            "status"=>1
          ],200);
        }
    }

    public function deleteById(int $modelId)
    {
      $delete =  $this->findById($modelId)->delete();
      if(!$delete){
        return response()->json([
          "message"=>"Data is not Deleted",
          "status"=>0
        ],500);
      }else{
        return response()->json([
          "message"=>"Data is  Deleted",
          "status"=>1
        ],200);
      }
    }

    public function search($search_value,array $columns=['*'],array $relations=[])
    {
        $value = $this->model->select($columns)->with($relations)->where('name','LIKE','%'.$search_value.'%')->orWhere('email','LIKE','%'.$search_value.'%')->orWhere('id','LIKE','%'.$search_value.'%')->orWhere('contact','LIKE','%'.$search_value.'%')->get();
        $value_count = count($value); 
        if($value_count == 0){
          return response()->json([
            "message"=>"$value_count Records Found",
            "status"=>0,
          ]);
        }
        return response()->json([
          "message"=>"$value_count Records Found",
          "status"=>1,
          "data"=> $value
        ]);
    }

    public function filter($filter_value,$search,array $columns=['*'],array $relations=[])
    {
      $get_filter = $this->model->select($columns)->with($relations)->where('department', $filter_value)->get();
      if(!$search){
        $filter_count = count($get_filter);
        if($filter_count == 0){
          return response()->json([
            "message"=>"$filter_count Records are found",
            "status"=>1,
            "data"=>$get_filter
          ],200);  
        }
        return response()->json([
          "message"=>"$filter_count Records are found",
          "status"=>1,
          "data"=>$get_filter
        ],200);
      }
      else{
        
        $users = $this->model->select($columns)->with($relations)->where('department',$filter_value)->where(function($query,)  {
          $query->where('name','Amit')
              ->orWhere('email','Amit+1@lawsikho.in')
              ->orWhere('contact','9015029734')
              ->orWhere('address','Gurugram')
              ->orWhere('contact','9015029734');

      })->get();
      return $users;

        // if(is_null($name)){
        //   $email = $this->model->select($columns)->with($relations)->where("email",'LIKE','%'.$search.'%')->where('department',$filter_value)->get();
        // return $email;
        // if(is_null($email)){
        //   $id = $this->model->select($columns)->with($relations)->where("id",'LIKE','%'.$search.'%')->where('department',$filter_value)->get();
        // return $id;
        //   }
        }
        
        
        // $search_data = $this->model->select($columns)->with($relations)->where("department",$filter_value)->orWhere(function($query){
        //   $query->where('name','LIKE', '%'.$search.'%');
        // })->get();
        // return $search_data;
      }
  
}
