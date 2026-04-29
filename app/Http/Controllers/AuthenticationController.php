<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Course;
use App\Models\Copyright;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    // Login basic
    public function login_basic()
    {
        $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $courses_nav = Course::where('status', 'PUBLISHED')->get();

        return view('/auth/auth-login-basic', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
    }

    // Login Cover
    public function login_cover()
    {
        $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $courses_nav = Course::where('status', 'PUBLISHED')->get();

        return view('/auth/auth-login-cover', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
    }

    // Register basic
    public function register_basic()
    {
        $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $courses_nav = Course::where('status', 'PUBLISHED')->get();

        return view('/auth/auth-register-basic', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
    }

    // Register cover
    public function register_cover()
    {
        $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $courses_nav = Course::where('status', 'PUBLISHED')->get();

        return view('/auth/auth-register-cover', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
    }

    // Forgot Password basic
    public function forgot_password_basic()
    {
        $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $courses_nav = Course::where('status', 'PUBLISHED')->get();

        return view('/auth/auth-forgot-password-basic', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
    }

    // Reset Password cover
    public function reset_password()
    {
        $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $courses_nav = Course::where('status', 'PUBLISHED')->get();

        return view('/auth/reset-password', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
    }

    // email verify basic
    public function verify_email_basic()
    {
        $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $courses_nav = Course::where('status', 'PUBLISHED')->get();

        return view('/auth/auth-verify-email-basic', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
    }

    // email verify cover
    public function verify_email()
    {
        $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $courses_nav = Course::where('status', 'PUBLISHED')->get();

        return view('/auth/auth-verify-email', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
    }

    // two steps cover
    public function two_steps()
    {
        $pageConfigs = ['pageHeader' => false];
$courses_nav = Course::where('status', 'PUBLISHED')->get();

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/auth/auth-two-steps', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
    }

    // register multi steps
    public function register()
    {
        $pageConfigs = ['pageHeader' => false];
$courses_nav = Course::where('status', 'PUBLISHED')->get();

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/auth/auth-register', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
    }

    // Forgot Password
    public function forgot_password()
    {
        $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $courses_nav = Course::where('status', 'PUBLISHED')->get();

        return view('/auth/auth-forgot-password', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
    }
}
