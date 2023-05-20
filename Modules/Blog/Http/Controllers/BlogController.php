<?php
namespace Modules\Blog\Http\Controllers;
use Modules\Blog\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class BlogController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        
        return response()->json($this->categoryRepository->all(),200);
        // return view('blog::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $info = [
            "name"=>$request->name,
            "email"=>$request->email,
            "contact"=>$request->contact,
            "pincode"=>$request->pincode,
            "address"=>$request->address,
            "department"=>$request->department,
            "password"=>Hash::make($request->password)
        ];
        return response()->json($this->categoryRepository->create($info),200);
       
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('blog::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $data = [
            "name"=>$request->name,
            "email"=>$request->email,
            "contact"=>$request->contact,
            "pincode"=>$request->pincode,
            "address"=>$request->address,
            "password"=>Hash::make($request->password)
        ];

        return response()->json($this->categoryRepository->update($id,$data),200);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        return response()->json($this->categoryRepository->deleteById($id));
    }

    public function search($search)
    {
        return response()->json($this->categoryRepository->search($search));
    }

    public function filter($filter,$search = null)
    {
        return response()->json($this->categoryRepository->filter($filter,$search));
    }
}
