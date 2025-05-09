<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $users = new UserModel();
        
        $user = new User([
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => 'admin123456',
        ]);
        
        $users->save($user);
        
        $user = $users->findById($users->getInsertID());
        
        // Adicionando o usuário ao grupo 'admin'
        $user->addGroup('admin');
    }
}
