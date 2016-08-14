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

    /**
     * Return a new JSON response from the application.
     *
     * @param  string|array  $data
     * @param  array         $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, array $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * Return a new JSON response from the application with status 204.
     *
     * @param  array  $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondEmpty(array $headers = [])
    {
        return $this->setStatusCode(204)->respond('', $headers);
    }

    /**
     * Return a new JSON response from the application with status 404.
     *
     * @param  string|array  $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * Return a new JSON error response from the application.
     *
     * @param  string|array  $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
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
