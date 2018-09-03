<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
use Illuminate\Cache\RateLimiter;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $loginUsernameType;

    protected $redirectTo = '/admin';

    protected $guard = 'admin';

    protected $loginView = 'admin.login';

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if (!$request->has('phone_code')) {
            // 校验登陆
            $this->validateLogin($request);
            dd($request);
        }
    }

    public function validateLogin(Request $request)
    {
        $attempts = $this->attempts($request);
        // 这是调用框架默认的
        if ($locked = $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }
        if (filter_var($request->name, FILTER_VALIDATE_INT)) {
            $this->loginUsernameType = 'phone';
            $rule_list = 'required|exists:admins,phone|digits:11';
        } else {
            $this->loginUsernameType = 'email';
            $rule_list = 'reuqired|email|exists:admins,email|max:30';
        }
        //用户信息校验
        $rules = [
            'name' => $rule_list,
            'password' => 'required|between:8,60'
        ];
    }

    public function attempts(Request $request)
    {
        return app(RateLimiter::class)->attempts();

    }

    public function getThrottlekey(Request $request)
    {
        return mb_strtolower($request->get('name')) . '|' . $request->ip();
    }

    protected function guard()
    {
        return auth()->guard('admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
