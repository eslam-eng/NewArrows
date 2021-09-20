<?php
    if (!function_exists('getLang'))
    {
        function getLange()
        {
            return app()->getLocale();
        }

    }

    if (!function_exists('apiResponse'))
    {
        function apiResponse($data=null,$msg=null,$code=200)
        {
            return [
                'data'=>$data,
                'msg'=>$msg,
                'status'=>in_array($code,successCode())?true:false,
            ];
        }

        function successCode()
        {
            return [
                200,201,202,202
            ];
        }

    }

    if (!function_exists('uploadImg'))
    {
    //  $file = $request->file('photo');
        function uploadImg($uploadedFile,$folder)
        {
            $file = $uploadedFile;
            $img_name = time().".".$file->getClientOriginalExtension();
            $file->move(public_path('uploads/'.$folder),$img_name);
            return $img_name ;

        }
    }
