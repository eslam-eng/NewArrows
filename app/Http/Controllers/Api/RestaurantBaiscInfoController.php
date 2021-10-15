<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RestaurantBasicInfo;
use Illuminate\Http\Request;

class RestaurantBaiscInfoController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['getPromoCode']]);
    }

    public function index($name)
    {
        $basicInfos = RestaurantBasicInfo::where('restaurant_name', $name)->get();
        if ($basicInfos->count())
            return apiResponse($basicInfos,'all info of'.$name,200) ;

        return apiResponse($basicInfos,'no info for'.$name,400);
    }

    public function create(Request $request,$name)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        $data['restaurant_name'] = $name;
        if (RestaurantBasicInfo::create($data))
            return apiResponse(null,'Basic Information inserted successfully',200);


    }

    public function update(Request $request,$id)
    {

        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $basicInfo = RestaurantBasicInfo::find($id);
        if (!$basicInfo)
            return apiResponse(null,'Basic Information not exist',200);

        $data = $request->all();
        $basicInfo->update($data);

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
            'photo'=>'nullable|string',
        ];
    }
}
