<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'getCategoryProducts']]);
    }

    public function index()
    {
        $categories = Category::with('restaurant')->get();
        return $categories;
    }

    public function create(Request $request)
    {

        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        if (Category::create($data))
            return apiResponse(null,'category inserted successfully',200);


    }

    public function update(Request $request,$id)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $category = Category::where('restaurant_id',auth()->id())->find($id);
        if (!$category)
            return apiResponse(null,'category not exist',200);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        $category->update($data);
        return apiResponse(null,'category updated successfully',200);

    }

    public function delete($id)
    {
        $category=Category::where('restaurant_id',auth()->id())->find($id);
        if (!$category)
            return apiResponse(null,'category not exist',200);

        if ($category->delete())
            return apiResponse(null,'category deleted successfully',200);
    }

    public function getCategoryProducts($id)
    {
        $data = Category::with('products')->where('restaurant_id',auth()->id())->find($id);
        if (!$data)
            return apiResponse(null,'category not exist',200);
        return $data;
    }


    private function rules(){
        return [
            "name"=>'required|string'
        ];
    }
}
