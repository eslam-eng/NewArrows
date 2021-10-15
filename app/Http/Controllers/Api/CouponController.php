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


    public function index($name)
    {
        $coupons= Coupon::where('restaurant_name',$name)->get();
        if ($coupons->count())
            return apiResponse($coupons,'all coupons of'.$name,200) ;

        return apiResponse($coupons,'no coupons for'.$name,400);
    }

    public function create(Request $request,$name)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $data = $request->all();
        $data['restaurant_name'] = $name;
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
//        $data['restaurant_name'] = $coupon->restaurant_name;
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

//    get promo-code

    public function getPromoCode(Request $request,$name)
    {
        $coupon=Coupon::where('coupon_code',$request->coupon_code)->where('restaurant_name',$name)->first();
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
