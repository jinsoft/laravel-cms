<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
use Illuminate\Cache\RateLimiter;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\LockoutEvent;
use Illuminate\Validation\ValidationException;
use Validator;
use App;
use Auth;

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
            //获取用户登陆凭证
            $credentials = $this->getCredentials($request);
            // 用户登陆
            if (Auth::guard('admin')->attempt($credentials)) {
                if (Auth::check()) {
                    //处理登陆成功
                    return $this->handleUserAuthenticateFailed($request);
                } else {
                    //二次验证
                }
            }
            return $this->handleUserAuthenticateFailed($request);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/admin');
    }

    public function handleUserAuthenticateFailed(Request $request)
    {
        //判断账号是否被禁用
        if ($admin = $this->guard()->getLastAttempted()) {
            if ($admin->forbidden) {
                $msg = trans('login.user_forbidden', ['name' => $request->name]);
                throw ValidationException::withMessages([$request->name => $msg]);
            }
        }
        #如果用户登录失败，则记录用户失败次数
        $this->incrementLoginAttempts($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request, 'admin', $this->attempts($request));
            return $this->sendLockoutResponse($request);
        }
        #返回失败信息
        return $this->sendFailedLoginResponse($request);
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
            $rule_list = 'required|safe_input|email|exists:admins,email|max:30';
        }
        //用户信息校验
        $rules = [
            'name' => $rule_list,
            'password' => 'required|strength_pwd|between:8,60',
        ];
        $v = Validator::make($request->all(), $rules);
        //当用户名输入错误次数达到阈值的时候触发验证码校验
        $v->sometimes('captcha', 'required|captcha', function () use ($request, $locked, $attempts) {
            if (App::environment('test')) {
                return false;
            }
            return ($attempts > config('logincfg.captcha_count') && !$locked);
        });

        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        }
    }

    public function attempts(Request $request)
    {
        return app(RateLimiter::class)->attempts($this->getThrottlekey($request));

    }

    public function getThrottlekey(Request $request)
    {
        return mb_strtolower($request->get('name')) . '|' . $request->ip();
    }

    public function getCredentials(Request $request)
    {
        $params = $request->only('name', 'password');
        $params[$this->loginUsernameType] = $params['name'];
        return array_except($params, ['name']);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Fire an event when a lockout occurs.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function fireLockoutEvent(Request $request, $user_type, $attempts)
    {
        event(new LockoutEvent($request, $user_type, $attempts));
    }
}
