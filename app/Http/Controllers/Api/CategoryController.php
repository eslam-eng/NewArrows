<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('restaurant_id',auth()->id())->get();
        return $categories;
    }

    public function create(Request $request)
    {
        $request->merge(['restaurant_id'=>auth()->id()]);
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        if (Category::create($request->all()))
            return apiResponse(null,'category inserted successfully',200);


    }

    public function update(Request $request,$id)
    {
        $request->merge(['restaurant_id'=>auth()->id()]);
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $category = Category::find($id);
        if (!$category)
            return apiResponse(null,'category not exist',200);

        $category->update($request->all());

        return apiResponse(null,'category updated successfully',200);

    }

    public function delete($id)
    {
        $category=Category::find($id);
        if (!$category)
            return apiResponse(null,'category not exist',200);

        if ($category->delete())
            return apiResponse(null,'category deleted successfully',200);
    }


    private function rules(){
        return [
            "name"=>'required|string'
        ];
    }
}
