<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{
    protected $userModel;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    
    public function index()
    {
        // Obter o ID do usuário logado
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->to('/admin/login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }
        
        $data = [
            'title' => 'Meu Perfil',
            'user' => $this->userModel->find($userId)
        ];
        
        return view('admin/pages/profile/index', $data);
    }
    
    public function update()
    {
        // Obter o ID do usuário logado
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->to('/admin/login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }
        
        // Validar os dados do formulário
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
        ];
        
        // Se a senha foi informada, adicionar regras de validação
        if ($this->request->getPost('password') != '') {
            $rules['password'] = 'required|min_length[6]';
            $rules['password_confirm'] = 'required|matches[password]';
        }
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Preparar dados para atualização
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];
        
        // Processar senha se foi informada
        if ($this->request->getPost('password') != '') {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        
        // Processar upload da foto
        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move('./uploads/users', $newName);
            $data['photo'] = 'uploads/users/' . $newName;
        }
        
        // Atualizar usuário
        $this->userModel->update($userId, $data);
        
        return redirect()->to('/admin/profile')->with('message', 'Perfil atualizado com sucesso!');
    }
} 