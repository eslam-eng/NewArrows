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

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
       if (Coupon::create($data))
         return apiResponse(null,'coupon created successfully',200);
    }

    public function update(Request $request,$id)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);
        $coupon = Coupon::find($id);
        if (!$coupon)
            return apiResponse(null,'coupon Not exist',400);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        $coupon->update($data);
        return apiResponse(null,'coupon updated successfully',200);

    }

    public function delete($id)
    {
        $coupon=Coupon::find($id);
        if (!$coupon)
            return apiResponse(null,'Coupon not exist',200);
        if ($coupon->delete())
            return apiResponse(null,'Coupon deleted successfully',200);
    }

    private function rules()
    {
       return [
           "coupon_code"=>"required|string",
           "coupon_value"=>"required|numeric"
       ];
    }
}
