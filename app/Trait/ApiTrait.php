<?php

namespace App\Trait;

trait ApiTrait
{
    public function apiResponse($code = 200, $message = null, $errors = [], $data = [])
    {
        $array = [
            'status'  => $code == 200,
            'message' => $message,
        ];

        if (empty($data) && !empty($errors)) {
            foreach ($errors as $key => $val) {
                $array['errors'][$key] = $val[0];
            }
        } elseif (!empty($data) && empty($errors)) {
            $array['data'] = $data;
        } else {
            $array['data'] = $data;
            $array['errors'] = $errors;
        }

        return response()->json($array, $code);
    }



}
