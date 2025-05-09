<?php

namespace App\Models;

use CodeIgniter\Model;

class ShopSettingModel extends Model
{
    protected $table            = 'shop_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'shop_name', 'shop_description', 'shop_logo', 'shop_favicon', 
        'shop_email', 'shop_phone', 'shop_whatsapp', 'shop_address', 
        'shop_city', 'shop_state', 'shop_zip', 'shop_country',
        'shop_currency', 'shop_currency_symbol', 
        'shop_facebook', 'shop_instagram', 'shop_twitter', 'shop_youtube',
        'whatsapp_default_message'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Obter todas as configurações da loja
     *
     * @return array
     */
    public function getSettings()
    {
        $settings = $this->first();
        
        // Se não existirem configurações, criar padrões
        if (empty($settings)) {
            $id = $this->createDefaultSettings();
            $settings = $this->find($id);
        }
        
        return $settings;
    }
    
    /**
     * Criar configurações padrão para a loja
     *
     * @return int ID das configurações criadas
     */
    public function createDefaultSettings()
    {
        $data = [
            'shop_name' => 'Mercado Vitrine',
            'shop_description' => 'Vitrine de produtos com contato direto via WhatsApp',
            'shop_email' => 'contato@seudominio.com.br',
            'shop_whatsapp' => '5511999999999',
            'shop_country' => 'Brasil',
            'shop_currency' => 'BRL',
            'shop_currency_symbol' => 'R$',
            'whatsapp_default_message' => 'Olá! Estou interessado no produto:'
        ];
        
        $this->insert($data);
        return $this->getInsertID();
    }
    
    /**
     * Atualizar as configurações da loja
     *
     * @param array $data Dados para atualizar
     * @return bool
     */
    public function updateSettings($data)
    {
        $settings = $this->first();
        
        if (empty($settings)) {
            $this->insert($data);
            return true;
        }
        
        return $this->update($settings['id'], $data);
    }
}
