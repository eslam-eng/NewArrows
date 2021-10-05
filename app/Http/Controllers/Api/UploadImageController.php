<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    public function uploadImg(Request $request)
    {
        if ($request->has('photo')){
            $imgname = uploadImg($request->file('photo'),'global');
            $url = env('APP_URL').'/uploads/global/'.$imgname;
            return $url;
        }
    }

    private function rules()
    {
        return [
           'photo'=>'nullable|image|mimes:jpj,png,gif,jpeg|max:2024',
        ];
    }
}
