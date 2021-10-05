<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'getBranchByRestaurantId']]);
    }

    public function index()
    {
//        $branches = User::with('branche')->get
        $branches = Branch::with('restaurant')->get();
        return $branches;

    }

    public function getBranchByRestaurantId(Request $request)
    {
        $branches = User::with('branch')->where('id',$request->restaurant_id)->get();
        return $branches;
    }

    public function create(Request $request)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        if (Branch::create($data))
            return apiResponse(null,'branches inserted successfully',200);


    }

    public function update(Request $request,$id)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $branch = Branch::where('restaurant_id',auth()->id())->find($id);
        if (!$branch)
            return apiResponse(null,'branch not exist',200);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        $branch->update($data);
        return apiResponse(null,'branch updated successfully',200);

    }

    public function delete($id)
    {
        $branch=Branch::where('restaurant_id',auth()->id())->find($id);
        if (!$branch)
            return apiResponse(null,'branch not exist',200);

        if ($branch->delete())
            return apiResponse(null,'branch deleted successfully',200);

    }

    private function rules()
    {
        return [
            'name'=>'required',
            'lat'=>'required',
            'lng'=>'required',
        ];
    }
}
