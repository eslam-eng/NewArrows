<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['getPromoCode']]);
    }


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
        $coupon = Coupon::where('restaurant_id',auth()->id())->find($id);
        if (!$coupon)
            return apiResponse(null,'coupon Not exist',400);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        $coupon->update($data);
        return apiResponse(null,'coupon updated successfully',200);

    }

    public function delete($id)
    {
        $coupon=Coupon::where('restaurant_id',auth()->id())->find($id);
        if (!$coupon)
            return apiResponse(null,'Coupon not exist',200);
        if ($coupon->delete())
            return apiResponse(null,'Coupon deleted successfully',200);
    }

//    get promo-code

    public function getPromoCode(Request $request)
    {
        $coupon=Coupon::where('coupon_code',$request->coupon_code)->where('restaurant_id',$request->restaurant_id)->first();
        if (!$coupon)
            return apiResponse(0,'Coupon not exist',200);

        return apiResponse($coupon->coupon_value,'Coupon discount '.$coupon->coupon_value,200);
    }

    private function rules()
    {
       return [
           "coupon_code"=>"required|string",
           "coupon_value"=>"required|numeric"
       ];
    }
}
