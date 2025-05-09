<?php

namespace App\Controllers;

class Product extends BaseController
{
    public function view($slug): string
    {
        $data = [
            'title' => 'Product: ' . ucwords(str_replace('-', ' ', $slug)) . ' - Nest eCommerce',
            'description' => 'View product details',
            'slug' => $slug
        ];
        return view('pages/product', $data);
    }

    public function viewType($type): string
    {
        $viewTypes = [
            'right' => 'product-right',
            'left' => 'product-left',
            'full' => 'product-full',
            'vendor' => 'product-vendor'
        ];

        $viewFile = isset($viewTypes[$type]) ? $viewTypes[$type] : 'product-right';

        $data = [
            'title' => 'Product View - Nest eCommerce',
            'description' => 'View product details',
            'type' => $type
        ];
        return view('pages/' . $viewFile, $data);
    }
} 