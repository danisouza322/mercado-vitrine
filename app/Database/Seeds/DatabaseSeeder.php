<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Executar AdminSeeder
        $this->call('AdminSeeder');
        
        // Executar ShopSettingSeeder
        $this->call('ShopSettingSeeder');
        
        // Log de confirmação
        echo "Todos os seeders foram executados com sucesso!\n";
    }
} 