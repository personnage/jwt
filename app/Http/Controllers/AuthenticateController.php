<?php

namespace App\Http\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;

class AuthenticateController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param  \App\Http\Requests\SignInRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(SignInRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->setStatusCode(401)->respondWithError('These credentials do not match our records');
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->setStatusCode(500)->respondWithError('Could not create token');
        }

       return $this->respond(['ok' => true], ['X-TOKEN' => $token]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Http\Requests\SignUpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(SignUpRequest $request)
    {
        $user = $this->create($request->only('email', 'username', 'password'));

        $token = JWTAuth::fromUser($user);

        // event(new UserCreated($user));

        return $this->setStatusCode(201)->respond(['ok' => true], ['X-TOKEN' => $token]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $credentials
     * @return User
     */
    protected function create(array $credentials)
    {
        return User::create([
            'email' => $credentials['email'],
            'username' => $credentials['username'],
            'password' => bcrypt($credentials['password']),
        ]);
    }
}
