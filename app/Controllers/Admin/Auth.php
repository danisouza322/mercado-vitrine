<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Se já estiver logado, redireciona para o dashboard
        if (auth()->loggedIn()) {
            return redirect()->to('admin');
        }
        
        return view('admin/pages/login');
    }
    
    public function attemptLogin()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $credentials = [
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        $loginAttempt = auth()->attempt($credentials);
        
        if (! $loginAttempt->isOK()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $loginAttempt->reason());
        }
        
        // Verificar se o usuário pertence aos grupos permitidos
        $user = auth()->user();
        if (! $user->inGroup('admin') && ! $user->inGroup('manager')) {
            auth()->logout();
            return redirect()->to('admin/login')
                ->with('error', 'Você não tem permissão para acessar o painel administrativo.');
        }
        
        return redirect()->to('admin')
            ->with('message', 'Login realizado com sucesso!');
    }
    
    public function logout()
    {
        auth()->logout();
        
        return redirect()->to('admin/login')
            ->with('message', 'Logout realizado com sucesso!');
    }
} 