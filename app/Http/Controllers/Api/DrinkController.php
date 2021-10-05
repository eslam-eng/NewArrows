<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function index()
    {
        $drinks = Drink::with('restaurant')->get();
        return $drinks;

    }

    public function create(Request $request)
    {

        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        if (Drink::create($data))
            return apiResponse(null,'drink inserted successfully',200);

    }

    public function update(Request $request,$id)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $drink = Drink::where('restaurant_id',auth()->id())->find($id);
        if (!$drink)
            return apiResponse(null,'drink not exist',200);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        $drink->update($data);
        return apiResponse(null,'drink updated successfully',200);
    }

    public function delete($id)
    {
        $drink=Drink::where('restaurant_id',auth()->id())->find($id);
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
