<?php

namespace App\Http\Controllers\Api\Auth;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * Create a new token controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['only' => ['payload']]);
        $this->middleware('jwt.refresh', ['only' => ['forceRefresh']]);
    }

    /**
     * Get the raw Payload instance.
     *
     * @return array
     */
    public function payload()
    {
        $payload = JWTAuth::parseToken()->getPayload()->toArray();

        return $this->respond(compact('payload'));
    }

    /**
     * Refresh an expired token.
     *
     * @return string
     */
    public function refresh(Request $request)
    {
        try {
           $token = JWTAuth::parseToken()->refresh();
        } catch (TokenInvalidException $e) {
            // 400
            return $this->setStatusCode($e->getStatusCode())
                ->respondWithError('Could not decode token')
            ;
        } catch (TokenExpiredException $e) {
            // 401
            return $this->setStatusCode($e->getStatusCode())
                ->respondWithError('Token has expired and can no longer be refreshed')
            ;
        } catch (JWTException $e) {
            // 500
            return $this->setStatusCode($e->getStatusCode())
                ->respondWithError('The token could not be parsed from the request')
            ;
        }

        return $this->respond(compact('token'));
    }

    /**
     * Refresh an expired token.
     *
     * @return null
     */
    public function forceRefresh()
    {
        return $this->respondEmpty();
    }
}
