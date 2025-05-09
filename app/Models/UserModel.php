<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'password', 'photo', 'role', 'status', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    protected $validationRules = [
        'name'     => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'required|min_length[6]',
    ];
    
    protected $validationMessages = [
        'name' => [
            'required' => 'O nome é obrigatório',
            'min_length' => 'O nome deve ter pelo menos {param} caracteres',
            'max_length' => 'O nome não pode ter mais de {param} caracteres',
        ],
        'email' => [
            'required' => 'O e-mail é obrigatório',
            'valid_email' => 'O e-mail informado não é válido',
            'is_unique' => 'Este e-mail já está sendo usado por outro usuário',
        ],
        'password' => [
            'required' => 'A senha é obrigatória',
            'min_length' => 'A senha deve ter pelo menos {param} caracteres',
        ],
    ];

    protected $skipValidation     = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    // Hash a senha antes de inserir ou atualizar
    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }
    
    // Verificar credenciais de login
    public function checkCredentials($email, $password)
    {
        $user = $this->where('email', $email)->first();
        
        if (!$user) {
            return false;
        }
        
        if (!password_verify($password, $user['password'])) {
            return false;
        }
        
        return $user;
    }
} 