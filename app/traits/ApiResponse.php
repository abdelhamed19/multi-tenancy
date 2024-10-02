<?php
namespace App\Traits;
trait ApiResponse{
    public function successResponse($data, $message, $code = 200){
        return response()->json([
            'data' => $data,
            'code' => $code,
            'status' => [
                'type' => 'success',
                'message' => $message
            ]
        ]);
    }
    public function errorResponse($message, $code){
        return response()->json([
            'data'=> null,
           'status' => [
                'type' => 'error',
                'message' => $message
           ],
            'code' => $code,
        ]);
    }

}
