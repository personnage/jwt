<?php

namespace App\Http\Controllers\Api\Auth;

use JWTAuth;
use App\User;
use App\Http\Requests\AuthJoinRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Controllers\Api\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use ThrottlesLogins;

    protected $username = 'username';

    /**
     * Handle a registration request for the application.
     *
     * @param  AuthJoinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(AuthJoinRequest $request)
    {
        $user = $this->create($request->all());

        // event(new UserRegistred($user));

         return $this->setStatusCode(201)->respond(['ok' => true]);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  AuthLoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(AuthLoginRequest $request)
    {
        // Get credentials from request to authorize.
        $credentials = $this->getCredentials($request);

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {

                $user = User::byUsername($credentials[$this->username]);
                event(new Failed($user, $credentials));

                return $this->setStatusCode(401)
                    ->respondWithError('These credentials do not match our records')
                ;
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->setStatusCode(500)->respondWithError('Could not create token');
        }

        // Get user by token.
        $user = JWTAuth::toUser($token);
        $token = JWTAuth::fromUser($user, $user->claims());

        event(new Login($user, false));

        // all good so return the token
        return $this->respond(compact('token'));
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only($this->username, 'password');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
