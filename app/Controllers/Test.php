<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class Test extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'System Test - Nest eCommerce',
            'description' => 'Testing the Nest eCommerce system'
        ];
        
        return view('pages/test/index', $data);
    }
    
    public function layout(): string
    {
        $data = [
            'title' => 'Layout Test - Nest eCommerce',
            'description' => 'Testing the layout system'
        ];
        
        return view('pages/test/layout', $data);
    }
    
    public function database(): ResponseInterface
    {
        $db = \Config\Database::connect();
        
        try {
            $db->query("SELECT 1");
            $data = [
                'status' => 'success',
                'message' => 'Database connection successful',
                'config' => [
                    'hostname' => $db->hostname,
                    'database' => $db->database,
                    'username' => $db->username,
                    'driver' => $db->DBDriver
                ]
            ];
        } catch (\Exception $e) {
            $data = [
                'status' => 'error',
                'message' => 'Database connection failed',
                'error' => $e->getMessage()
            ];
        }
        
        return $this->response->setJSON($data);
    }
    
    public function session(): ResponseInterface
    {
        $session = session();
        $session->set('test_time', time());
        
        $data = [
            'status' => 'success',
            'message' => 'Session test',
            'session_id' => $session->id,
            'session_data' => [
                'test_time' => $session->get('test_time')
            ]
        ];
        
        return $this->response->setJSON($data);
    }
    
    public function info(): ResponseInterface
    {
        $data = [
            'php_version' => phpversion(),
            'codeigniter_version' => \CodeIgniter\CodeIgniter::CI_VERSION,
            'environment' => ENVIRONMENT,
            'base_url' => base_url(),
            'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'request_method' => $this->request->getMethod(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'is_ajax' => $this->request->isAJAX(),
            'ip_address' => $this->request->getIPAddress()
        ];
        
        return $this->response->setJSON($data);
    }
} 