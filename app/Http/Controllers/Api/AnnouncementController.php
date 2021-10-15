<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index($name)
    {
        $ads = Announcement::where('restaurant_name',$name)->get();
        if ($ads->count())
            return apiResponse($ads,'all ads of'.$name,200) ;

        return apiResponse($ads,'no ads for'.$name,400);

    }

    public function create(Request $request,$name)
    {

        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        $data['restaurant_name'] = $name;
        if (Announcement::create($data))
            return apiResponse(null,'ads inserted successfully',200);

    }

    public function update(Request $request,$id)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $ads = Announcement::find($id);
        if (!$ads)
            return apiResponse(null,'ads not exist',200);

        $data = $request->all();
//        $data['restaurant_id'] = auth()->id();
//        $data['restaurant_name'] = $ads->restaurant_name;
        $ads->update($data);
        return apiResponse(null,'ads updated successfully',200);
    }

    public function delete($id)
    {
        $ads=Announcement::find($id);
        if (!$ads)
            return apiResponse(null,'ads not exist',200);

        if ($ads->delete())
            return apiResponse(null,'ads deleted successfully',200);
    }

    private function rules()
    {
        return [
            'ads'=>'required|string'
        ];
    }
}
