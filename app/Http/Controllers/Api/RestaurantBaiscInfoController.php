<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RestaurantBasicInfo;
use Illuminate\Http\Request;

class RestaurantBaiscInfoController extends Controller
{
    public function index()
    {
        $basicInfos = RestaurantBasicInfo::where('restaurant_id', auth()->id())->get();
        return $basicInfos;
    }

    public function create(Request $request)
    {
        $request->merge(['restaurant_id'=>auth()->id()]);
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        if (RestaurantBasicInfo::create($request->all()))
            return apiResponse(null,'Basic Information inserted successfully',200);


    }

    public function update(Request $request,$id)
    {

        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $basicInfo = RestaurantBasicInfo::find($id);
        $request->merge(['restaurant_id'=>auth()->id()]);
        if (!$basicInfo)
            return apiResponse(null,'Basic Information not exist',200);

        $basicInfo->update($request->all());

        return apiResponse(null,'Basic Information updated successfully',200);

    }

    public function delete($id)
    {
        $basicInfo = RestaurantBasicInfo::find($id);
        if (!$basicInfo)
            return apiResponse(null,'Basic Information not exist',200);

        if ($basicInfo->delete())
            return apiResponse(null,'Basic Information deleted successfully',200);
    }


    private function rules(){
        return [
            'name'=>'required|string',
            'address'=>'required|string',
            'desc'=>'nullable|string',
            'photo'=>'nullable|image|mimes:jpj,png,gif,jpeg|max:2024',
        ];
    }
}