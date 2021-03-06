<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'getProductById']]);
    }
    public function index($name)
    {
        $products = Product::where('restaurant_name',$name)->get();
        if ($products->count())
            return apiResponse($products,'all products of'.$name,200) ;

        return apiResponse($products,'no products for'.$name,400);
    }

    public function getProductById($id)
    {
        $product=Product::with('category')->find($id);
        if (!$product)
            return apiResponse(null,'product not exist',400);

        return $product ;
    }

    public function create(Request $request,$name)
    {
        $validator = validator($request->all(), $this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(), null, 400);
        $data = $request->all();
        $data['restaurant_id']=auth()->id();
        $data['restaurant_name']= $name;
//        if ($request->has('photo')){
//            $data['photo'] = uploadImg($request->file('photo'),'products');
//        }
        if (Product::create($data))
            return apiResponse(null, 'Product inserted successfully', 200);

    }

    public function update(Request $request,$id)
    {
        $product = Product::where('restaurant_id',auth()->id())->find($id);
        if (!$product)
            return apiResponse(null, 'product not exist', 400);

        $validator = validator($request->all(), $this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(), null, 400);

        $data = $request->all();
//        $data['restaurant_id']=auth()->id();
        if ($request->has('photo')){
            $product->photo!=''?unlink(public_path('uploads\products\\'.$product->photo)):null;
            $data['photo'] = uploadImg($request->file('photo'),'products');
        }
        if ($product->update($data))
            return apiResponse(null, 'Product updated successfully', 200);

    }

    public function delete($id)
    {
        $product=Product::find($id);
        if (!$product)
            return apiResponse(null,'product not exist',200);
        $product->photo!=''?unlink(public_path('uploads\products\\'.$product->photo)):null;
        if ($product->delete())
            return apiResponse(null,'product deleted successfully',200);
    }

    private function rules()
    {
        return[
        'name'=>'required|string',
//        'photo'=>'nullable|image|mimes:jpj,png,gif,jpeg|max:2024',
        'photo'=>'nullable|string',
        'category_id'=>'required|exists:categories,id',
        'components'=>'nullable|array',
        'sizes'=>'nullable|array',
        'additional'=>'nullable|array'
        ];
    }

}
