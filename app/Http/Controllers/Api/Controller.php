<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    protected $statusCode = 200;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respond($data, array $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondEmpty(array $headers = [])
    {
        return $this->setStatusCode(204)->respond(null, $headers);
    }

    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }
}
