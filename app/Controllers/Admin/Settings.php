<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ShopSettingModel;

class Settings extends BaseController
{
    protected $shopSettingModel;
    
    public function __construct()
    {
        $this->shopSettingModel = new ShopSettingModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Configurações da Loja',
            'settings' => $this->shopSettingModel->getSettings()
        ];
        
        return view('admin/pages/settings/index', $data);
    }
    
    public function update()
    {
        $rules = [
            'shop_name' => 'required|min_length[3]',
            'shop_email' => 'permit_empty|valid_email',
            'shop_whatsapp' => 'permit_empty|min_length[10]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }
        
        $settings = $this->shopSettingModel->getSettings();
        $data = $this->request->getPost();
        
        // Processar upload do logo
        $logo = $this->request->getFile('shop_logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $newName = $logo->getRandomName();
            $logo->move(FCPATH . 'uploads/settings', $newName);
            $data['shop_logo'] = 'uploads/settings/' . $newName;
            
            // Remover logo antigo se existir
            if (!empty($settings['shop_logo']) && file_exists(FCPATH . $settings['shop_logo'])) {
                unlink(FCPATH . $settings['shop_logo']);
            }
        } else {
            // Manter o logo atual se nenhum novo for enviado
            if (isset($data['shop_logo'])) {
                unset($data['shop_logo']);
            }
        }
        
        // Processar upload do favicon
        $favicon = $this->request->getFile('shop_favicon');
        if ($favicon && $favicon->isValid() && !$favicon->hasMoved()) {
            $newName = $favicon->getRandomName();
            $favicon->move(FCPATH . 'uploads/settings', $newName);
            $data['shop_favicon'] = 'uploads/settings/' . $newName;
            
            // Remover favicon antigo se existir
            if (!empty($settings['shop_favicon']) && file_exists(FCPATH . $settings['shop_favicon'])) {
                unlink(FCPATH . $settings['shop_favicon']);
            }
        } else {
            // Manter o favicon atual se nenhum novo for enviado
            if (isset($data['shop_favicon'])) {
                unset($data['shop_favicon']);
            }
        }
        
        $this->shopSettingModel->updateSettings($data);
        
        return redirect()->to('admin/settings')
            ->with('message', 'Configurações atualizadas com sucesso!');
    }
} 