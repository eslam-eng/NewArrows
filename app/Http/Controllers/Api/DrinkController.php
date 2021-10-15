<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['getPromoCode']]);
    }

    public function index($name)
    {
        $drinks = Drink::where('restaurant_name',$name)->get();
        if ($drinks->count())
            return apiResponse($drinks,'all drinks of'.$name,200) ;

        return apiResponse($drinks,'no drinks for'.$name,400);

    }

    public function create(Request $request,$name)
    {

        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $data = $request->all();
        $data['restaurant_name'] = $name;
        $data['restaurant_id'] = auth()->id();
        if (Drink::create($data))
            return apiResponse(null,'drink inserted successfully',200);

    }

    public function update(Request $request,$id)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $drink = Drink::find($id);
        if (!$drink)
            return apiResponse(null,'drink not exist',200);

        $data = $request->all();
//        $data['restaurant_name'] = $drink->restaurant_name;
        $drink->update($data);
        return apiResponse(null,'drink updated successfully',200);
    }

    public function delete($id)
    {
        $drink=Drink::find($id);
        if (!$drink)
            return apiResponse(null,'drink not exist',200);

        if ($drink->delete())
            return apiResponse(null,'drink deleted successfully',200);
    }

    private function rules()
    {
        return [
            'photo'=>'nullable|string',
            'name'=>'required|string',
            'category_id'=>'required|exists:categories,id',

        ];
    }
}
