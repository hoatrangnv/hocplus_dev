<?php

namespace Hocplus\Frontend\App\Http\Controllers\Auth;

use Adtech\Application\Cms\Controllers\MController as Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hocplus\Frontend\App\Models\Teacher;
use Validator, Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    private function _guard()
    {
        return Auth::guard('member');
    }

    private function _guardTeacher()
    {
        return Auth::guard('teacher');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    private function _authenticate(Request $request)
    {
        if (!$request->isXmlHttpRequest()) return response('404 not found', 404);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember', false);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($this->_guard()->attempt(['email' => $email, 'password' => $password, 'activated' => 1], $remember)) {
                $request->session()->regenerateToken();
                $this->clearLoginAttempts($request);
                $status = Auth::guard('member')->user()->status;
                return ['success' => true ,'status' => $status];
            } else {
                return ['success' => false];
            }
        } else {
            if ($this->_guard()->attempt(['phone' => $email, 'password' => $password, 'activated' => 1], $remember)) {
                $request->session()->regenerateToken();
                $this->clearLoginAttempts($request);
                $status = Auth::guard('member')->user()->status;
                return ['success' => true ,'status' => $status];
            } else {
                return ['success' => false];
            }
        }
    }

    private function _authenticateTeacher(Request $request)
    {
        if (!$request->isXmlHttpRequest()) return response('404 not found', 404);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember', false);

        $user = Teacher::where('activated', 1)
            ->where(function ($query) use ($email) {
                $query->orWhere('user_name', $email)
                    ->orWhere('phone', $email)
                    ->orWhere('email', $email);
            })
            ->first();

        if (!$user) {
            return ['success' => false];
        }

        if ($this->_guardTeacher()->attempt(['teacher_id' => $user->teacher_id, 'password' => $password], $remember)) {
            $request->session()->regenerateToken();
            $this->clearLoginAttempts($request);

            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function login(Request $request)
    {
        if ($this->user) {
            $routeName = 'hocplus.frontend.index';
            return redirect()->intended(route($routeName));
        }

        if ($request->ajax()) {
            if ($request->isMethod('post')) {
                $authenticate = $this->_authenticate($request);
                echo json_encode($authenticate);
            } else {
                return view('HOCPLUS-FRONTEND::modules.frontend.homepage.index');
            }
        } else {
            return view('HOCPLUS-FRONTEND::modules.frontend.homepage.index');
        }
    }

    public function loginTeacher(Request $request)
    {   
        
        if ($this->_guardTeacher()->check()) {
            $routeName = 'hocplus.get.register.teacher';
            return redirect()->intended(route($routeName));
        }
        if ($request->ajax()) {
            if ($request->isMethod('post')) {
                $authenticate = $this->_authenticateTeacher($request);

                echo json_encode($authenticate);
            } else {
                return view('HOCPLUS-FRONTEND::modules.frontend.homepage.index');
            }
        } else {
            return view('HOCPLUS-FRONTEND::modules.frontend.homepage.index');
        }
    }

    public function logout(Request $request)
    {
        if (Auth::guard('member')->check()) {
            $this->_guard()->logout();
            \Session::flash('flash_messenger', trans('adtech-core::messages.logout_success'));
            return redirect(route('hocplus.frontend.index'));
        } else if ($this->_guardTeacher()->check() ) {
            $this->_guardTeacher()->logout();
            \Session::flash('flash_messenger', trans('adtech-core::messages.logout_success'));
            return redirect(route('hocplus.get.register.teacher'));
        }

//        \Session::flush();
        
        
    }
}
