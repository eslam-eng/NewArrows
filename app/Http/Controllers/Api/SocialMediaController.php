<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['getPromoCode']]);
    }

    public function index($name)
    {
        $socials = SocialMedia::where('restaurant_name', $name)->get();
        return $socials;
    }

    public function create(Request $request,$name)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        $data['restaurant_name'] = $name;
        if (SocialMedia::create($data))
            return apiResponse(null,'Social links and phones inserted successfully',200);


    }

    public function update(Request $request,$id)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $social = SocialMedia::find($id);
        if (!$social)
            return apiResponse(null,'Social not exist',200);

        $data = $request->all();
//        $data['restaurant_id'] = auth()->id();
//        $data['restaurant_name'] = $name;
        $social->update($data);

        return apiResponse(null,'Social links and phones updated successfully',200);

    }

    public function delete($id)
    {
        $social=SocialMedia::find($id);
        if (!$social)
            return apiResponse(null,'social not exist',200);

        if ($social->delete())
            return apiResponse(null,'social deleted successfully',200);
    }


    private function rules(){
        return [
            'phone_1'=>'required|string',
            'phone_2'=>'nullable|string',
            'phone_3'=>'nullable|string',
            'facebook'=>'nullable|string',
            'twitter'=>'nullable|string',
            'instagram'=>'nullable|string',
            'snapchat'=>'nullable|string',
	        'website'=>'nullable|string'
        ];
    }


}
