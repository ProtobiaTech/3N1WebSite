<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator, Input, Auth, Mail;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Dev4living\LeanCloudSMS\LeanCloudSMS;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:users',
            'phone' => 'required|integer|unique:users',
            'verifyCode' => 'required|integer',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $verifyRet = $this->verifyRegisterPhoneCode($request->input('phone'), $request->input('verifyCode'));
        if (!isset($verifyRet['error'])) {
            Auth::login($this->create($request->all()));

            // welcome mail
            Mail::send(
                'emails.welcome',
                [
                    'name' => $request->input('name'),
                    'siteName' => '3N1WebSite',
                    'siteUrl' => 'http://3n1website.dev4living.com'
                ],
                function($message) {
                    global $request;
                    $message->from(env('WEBSITE_MAIL', ''), env('WEBSITE_MAIL_NAME', ''));
                    $message->to($request->input('email'), $request->input('name'))->subject('Welcome!');
                }
            );

            return redirect($this->redirectPath());
        } else {
            $messageBag = (new MessageBag)->add('verifyCode', $verifyRet['error']);
            return redirect()->back()->withInput($request->all())->withErrors($messageBag);
        }
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
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Get register phone code
     * It applies only to handle ajax requests
     *
     * @return void
     */
    public function getGetRegisterPhoneCode()
    {
        $phoneNumber = Input::get('phoneNumber');
        $config['header'] = explode('|', env('LEANCLOUD_REQUEST_SMS_HEADER'));
        $data = '{"mobilePhoneNumber": "' . $phoneNumber . '"}';

        $ret = LeanCloudSMS::init($config)->requestSmsCode($data);
        $ret = json_decode($ret, true);
        // dd($ret['error']);
        if (isset($ret['error'])) {
            abort(500, $ret['error']);
        } else {
            echo trans('user.Get register phone code success');
        }
    }

    /**
     * Verify register phone code
     *
     * @param integer $phoneNumber  Phone number, 11 digits
     * @param integet $verifyCode   Verify code, 6 digits
     * @return array                The resules
     */
    public function verifyRegisterPhoneCode($phoneNumber, $verifyCode)
    {
        $config['header'] = explode('|', env('LEANCLOUD_VERIFY_SMS_HEADER'));
        $data = [
            'mobilePhoneNumber'     =>  $phoneNumber,
            'verifyCode'            =>  $verifyCode,
        ];

        $ret = LeanCloudSMS::init($config)->verifySmsCode($data);
        return json_decode($ret, true);
    }
}
