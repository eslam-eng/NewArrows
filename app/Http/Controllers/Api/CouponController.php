<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons= Coupon::where('restaurant_id',auth()->id())->get();
        return $coupons ;
    }

    public function create(Request $request)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $request->merge(['restaurant_id'=>auth()->id()]);
       if (Coupon::create($request->all()))
         return apiResponse(null,'coupon created successfully',200);
    }

    public function update(Request $request,$id)
    {
        $request->merge(['restaurant_id'=>auth()->id()]);
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);
        $coupon = Coupon::find($id);
        if (!$coupon)
            return apiResponse(null,'coupon Not exist',400);

        $coupon->update($request->all());
        return apiResponse(null,'coupon updated successfully',200);

    }


    private function rules()
    {
       return [
           "coupon_code"=>"required|string",
           "coupon_value"=>"required|numeric"
       ];
    }
}
