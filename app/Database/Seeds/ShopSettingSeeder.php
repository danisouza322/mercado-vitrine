<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ShopSettingSeeder extends Seeder
{
    public function run()
    {
        // Verificar se já existem dados na tabela
        $shopSettingModel = new \App\Models\ShopSettingModel();
        $existingSettings = $shopSettingModel->first();
        
        if (!empty($existingSettings)) {
            echo "As configurações da loja já existem. Pulando seeder.\n";
            return;
        }
        
        // Dados iniciais para as configurações da loja
        $data = [
            'shop_name' => 'Mercado Vitrine',
            'shop_description' => 'Vitrine de produtos com contato direto via WhatsApp',
            'shop_logo' => 'assets/imgs/theme/logo.svg',
            'shop_favicon' => 'assets/imgs/theme/favicon.svg',
            'shop_email' => 'contato@seudominio.com.br',
            'shop_phone' => '(11) 3333-4444',
            'shop_whatsapp' => '5511999999999',
            'shop_address' => 'Rua Exemplo, 123',
            'shop_city' => 'São Paulo',
            'shop_state' => 'SP',
            'shop_zip' => '01000-000',
            'shop_country' => 'Brasil',
            'shop_currency' => 'BRL',
            'shop_currency_symbol' => 'R$',
            'shop_facebook' => 'https://facebook.com/sua-loja',
            'shop_instagram' => 'https://instagram.com/sua-loja',
            'shop_twitter' => '',
            'shop_youtube' => '',
            'whatsapp_default_message' => 'Olá! Estou interessado no produto: [nome-produto]. Poderia me dar mais informações?',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        // Inserir os dados
        $shopSettingModel->insert($data);
        
        echo "Configurações da loja adicionadas com sucesso!\n";
    }
}
