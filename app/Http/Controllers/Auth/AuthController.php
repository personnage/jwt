<?php

namespace App\Http\Controllers\Auth;

use JWTAuth;
use App\User;
use App\Http\Requests\AuthJoinRequest;
use App\Http\Requests\AuthLoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $username = 'username';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  AuthJoinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(AuthJoinRequest $request)
    {
        $user = $this->create($request->all());
        $token = JWTAuth::fromUser($user, $user->claims());

         return $this->setStatusCode(201)->respond(compact('token'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param  AuthLoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(AuthLoginRequest $request)
    {
        $credentials = $this->getCredentials($request);

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->setStatusCode(401)
                    ->respondWithError('These credentials do not match our records')
                ;
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->setStatusCode(500)->respondWithError('Could not create token');
        }

        // all good so return the token
        return $this->respond(compact('token', 'user'));
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password');
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
