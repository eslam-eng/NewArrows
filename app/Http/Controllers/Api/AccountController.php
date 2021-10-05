<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::with('restaurant')->get();
        return $accounts;

    }

    public function create(Request $request)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        if (Account::create($data))
            return apiResponse(null,'Accounts inserted successfully',200);


    }

    public function update(Request $request,$id)
    {
        $validator =validator($request->all(),$this->rules());
        if ($validator->fails())
            return apiResponse($validator->errors()->all(),null,400);

        $branch = Account::where('restaurant_id',auth()->id())->find($id);
        if (!$branch)
            return apiResponse(null,'account not exist',200);

        $data = $request->all();
        $data['restaurant_id'] = auth()->id();
        $branch->update($data);
        return apiResponse(null,'account updated successfully',200);

    }

    public function delete($id)
    {
        $account=Account::where('restaurant_id',auth()->id())->find($id);
        if (!$account)
            return apiResponse(null,'account not exist',200);

        if ($account->delete())
            return apiResponse(null,'account deleted successfully',200);

    }

    private function rules()
    {
        return [
            'tax'=>'nullable|numeric',
            'delivery_value'=>'nullable|numeric',
            'fees_value'=>'required|numeric',
        ];
    }
}
