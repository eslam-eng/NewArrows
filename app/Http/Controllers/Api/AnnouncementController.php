<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $ads = Announcement::with('restaurant')->get();
        return $ads;

    }

    public function create(Request $request)
    {

        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        if (Announcement::create($data))
            return apiResponse(null,'ads inserted successfully',200);

    }

    public function update(Request $request,$id)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $ads = Announcement::where('restaurant_id',auth()->id())->find($id);
        if (!$ads)
            return apiResponse(null,'ads not exist',200);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        $ads->update($data);
        return apiResponse(null,'ads updated successfully',200);
    }

    public function delete($id)
    {
        $ads=Announcement::where('restaurant_id',auth()->id())->find($id);
        if (!$ads)
            return apiResponse(null,'ads not exist',200);

        if ($ads->delete())
            return apiResponse(null,'ads deleted successfully',200);
    }

    private function rules()
    {
        return [
            'name'=>'required|string'
        ];
    }
}
