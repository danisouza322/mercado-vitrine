<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Account extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'My Account - Nest eCommerce',
            'description' => 'View your account details'
        ];
        return view('pages/account', $data);
    }

    public function login(): string
    {
        $data = [
            'title' => 'Login - Nest eCommerce',
            'description' => 'Login to your account'
        ];
        return view('pages/login', $data);
    }

    public function register(): string
    {
        $data = [
            'title' => 'Register - Nest eCommerce',
            'description' => 'Create a new account'
        ];
        return view('pages/register', $data);
    }

    public function logout(): RedirectResponse
    {
        // Perform logout actions
        return redirect()->to(base_url());
    }

    public function forgotPassword(): string
    {
        $data = [
            'title' => 'Forgot Password - Nest eCommerce',
            'description' => 'Reset your password'
        ];
        return view('pages/forgot-password', $data);
    }

    public function resetPassword(): string
    {
        $data = [
            'title' => 'Reset Password - Nest eCommerce',
            'description' => 'Set a new password'
        ];
        return view('pages/reset-password', $data);
    }
} 