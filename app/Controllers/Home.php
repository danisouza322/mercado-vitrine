<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Nest - Multipurpose eCommerce HTML Template',
            'description' => 'Nest is a multipurpose eCommerce HTML template'
        ];
        return view('pages/home', $data);
    }

    public function about(): string
    {
        $data = [
            'title' => 'About Us - Nest eCommerce',
            'description' => 'Learn more about Nest eCommerce'
        ];
        return view('pages/about', $data);
    }

    public function contact(): string
    {
        $data = [
            'title' => 'Contact Us - Nest eCommerce',
            'description' => 'Contact Nest eCommerce for any inquiries'
        ];
        return view('pages/contact', $data);
    }
}
