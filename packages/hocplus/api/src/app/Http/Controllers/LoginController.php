<?php

namespace Hocplus\Api\App\Http\Controllers;

use Adtech\Application\Cms\Controllers\AController as Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hocplus\Frontend\App\Models\Teacher;
use Hocplus\Api\App\Models\TokenLogin;
use Hocplus\Api\App\Models\Member;
use Validator, Auth;

class LoginController extends Controller
{
    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    use AuthenticatesUsers;
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    public function __construct()
    {
        \Debugbar::disable();
    }

    private function _guard()
    {
        return Auth::guard('member');
    }
    

    /**
     * @param Request $request
     * @return mixed
     */
    private function _authenticate(Request $request)
    {
        // if (!$request->isXmlHttpRequest()) return response('404 not found', 404);
        $username = $request->input('username');
        $password = $request->input('password');
        $data = [
            'success' => false,
            'status' => 1,
            'message' => 'Đăng nhập không thành công kiểm tra thông tin đăng nhập.',
        ];
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            if ($this->_guard()->attempt(['email' => $username, 'password' => $password])) {
                $member_info = Auth::guard('member')->user();
                if($member_info->activated == 0){
                    $data = [
                        'success' => false,
                        'status' => 2,
                        'message' => 'Tài khoản chưa được xác thực!',
                    ];
                    $data_encode = json_encode($data);
                    return $data_encode;
                }
                $request->session()->regenerateToken();
                $this->clearLoginAttempts($request);
                //get info login
                $info_login = self::getInfo($member_info);
                return $info_login;
            } else {
                $data_encode = json_encode($data);
                return $data_encode;
            }
        } else {
            if ($this->_guard()->attempt(['phone' => $username, 'password' => $password])) {
                if($member_info->activated == 0){
                    $data = [
                        'success' => false,
                        'status' => 2,
                        'message' => 'Tài khoản chưa được xác thực!',
                    ];
                    $data_encode = json_encode($data);
                    return $data_encode;
                }
                $request->session()->regenerateToken();
                $this->clearLoginAttempts($request);

                //get info login
                $info_login = self::getInfo($member_info);
                return $info_login;
            } else {
                $data_encode = json_encode($data);
                return $data_encode;
            }
        }
    }


    

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            if ($request->isMethod('post')) {
                $authenticate = $this->_authenticate($request);
                return $authenticate;
            } else {
                return 'Something error';
            }
        } else{
            return self::message(false, 'Token không hợp lệ');  
        }
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'token' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $data = [
                'success' => false,
                'message' => 'Đăng xuất thất bại',
            ]; 
            $member_id = $request->input('member_id');
            $token = $request->input('token');
            $token_login = TokenLogin::where('member_id', $member_id)->where('token', $token)->delete();
            if($token_login){
                $data = [
                    'success' => true,
                    'message' => 'Đăng xuất thành công',
                ]; 
            }
            $data_encode = json_encode($data);
            return $data_encode; 
        } else{
            return self::message(false, 'Token không hợp lệ');     
        }
    }

    //gen token by login
    public function genToken($member_id){
        $token_login = TokenLogin::where('member_id', $member_id)->first();
        if(!$token_login){
            $token = str_random('60');
            $fp = new TokenLogin([
                'member_id' => $member_id,
                'token' => $token,
                'expired_at' => time() + 3600
            ]);
            $fp->save();
        } else{
            $token = $token_login->token;    
        }
        return $token;
    }

    //get info reponse login
    public function getInfo($member_info){
        $status = $member_info->status;
        $member_id = $member_info->member_id;
        $name = ($member_info->name != '') ? $member_info->name : $member_info->email;
        $name = $name != '' ? $name : $member_info->phone;
        $username = $member_info->email != '' ? $member_info->email : $member_info->phone;
        //create token
        $token = self::genToken($member_id);
        //end create token
        $data = [
            'success' => true,
            'message' => 'Đăng nhập thành công',
            'status' => $status,
            'token' => $token,
            'member_id' => $member_info->member_id,
            'name' => $name,
            'username' => $username
        ];
        $data_encode = json_encode($data);
        return $data_encode;
    }

    //verify token
    public function verify(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $token = $request->input('token');
            $token_login = TokenLogin::where('token', $token)->first();
            // dd('1');
            if($token_login) {
                $member_id = $token_login->member_id;
                $member_info = Member::find($member_id);
                $data = [
                    'member_info' => $member_info,
                    'success' => true,
                    'message' => 'Lấy thông tin thành công',
                ];    
                $data_encode = json_encode($data);
                return $data_encode;   
            } else{
                return self::message(false, 'Token không hợp lệ');    
            }
        } else{
            return self::message(false, 'Token không hợp lệ');    
        }   
    }

    public function message($success, $message){
        $data = [
            'success' => $success,
            'message' => $message,
        ];    
        $data_encode = json_encode($data);
        return $data_encode;    
    }
}
