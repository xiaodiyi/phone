<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Overtrue\EasySms\EasySms;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('auth.phonelogin');
    }

    public function LoginData(){
        $key = 'login.code.'.request()->phone;
        //判断缓存是否存在这个key并取出来和用户的对比
        if(Cache::has($key) && Cache::get($key) == request()->code){
            $user =User::firstOrcreate([
                'phone'=>request()->phone,
            ],[
                'name'=>request()->phone,
                'phone'=>request()->phone
            ]);
            Auth::login($user);
            return redirect('/');
        }
        return back();
    }
    public function sendLoginPhoneCode()
    {
        $phone =request()->phone;
        $code = random_int('1000','9999');
        $time=30;
        //写入缓存
        Cache::put('login.code.'.$phone,$code,1);
//        dd($phone);
        //jia  判断缓存中是否有验证码了，有就直接返回信息状态说明验证码已经存在，在规定时间内不能再发送，防止csrf攻击
        $easySms = new EasySms(config('sms'));
        $data =$easySms->send($phone, [
            'template' => '1',
            'data' => [
                $code,
                $time
            ],
        ]);
            return response()->json([
                'status'=>'success',
                'code'=>$code
            ]);

//            return response()->json([
//                'status'=>'failed'
//            ]);

    }
}
