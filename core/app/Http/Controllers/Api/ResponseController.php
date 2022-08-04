<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ResponseController extends Controller
{

    public function sendResponse($data, $message = "")
    {
    	$response = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }

    public function sendError($error, $code = 404, $errorMessages = [])
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}