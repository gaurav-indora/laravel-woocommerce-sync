<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

if (!function_exists('validate_form')) {
    function validate_form(Request $request, $customerId = null)
    {
        $rules = [
            'name' => 'required',
            'description'  => 'required',
            'price' => 'required',
            'image_url'  => 'required'
           
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }

        return response()->json([
            'status' => 'success'
        ]);
    }
}

if (!function_exists('geturl')) {
    function geturl()
    {
        return "https://shutclass.s3-tastewp.com";
    }
}

if (!function_exists('getWooKey')) {
    function getWooKey()
    {
        return "ck_dfe4e91c4f50617c92acec2db9c14bf12cb70419";
    }
}

if (!function_exists('getWooSecret')) {
    function getWooSecret()
    {
        return "cs_1a13da52eb8c09f9a35c5c46535396e4867f6327";
    }
}


