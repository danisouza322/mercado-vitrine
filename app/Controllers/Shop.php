<?php

namespace App\Controllers;

class Shop extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Shop - Nest eCommerce',
            'description' => 'Browse our products'
        ];
        return view('pages/shop', $data);
    }

    public function gridLeft(): string
    {
        $data = [
            'title' => 'Shop Grid Left - Nest eCommerce',
            'description' => 'Browse our products in grid view with left sidebar'
        ];
        return view('pages/shop-grid-left', $data);
    }

    public function listRight(): string
    {
        $data = [
            'title' => 'Shop List Right - Nest eCommerce',
            'description' => 'Browse our products in list view with right sidebar'
        ];
        return view('pages/shop-list-right', $data);
    }

    public function listLeft(): string
    {
        $data = [
            'title' => 'Shop List Left - Nest eCommerce',
            'description' => 'Browse our products in list view with left sidebar'
        ];
        return view('pages/shop-list-left', $data);
    }

    public function fullwidth(): string
    {
        $data = [
            'title' => 'Shop Full Width - Nest eCommerce',
            'description' => 'Browse our products in full width view'
        ];
        return view('pages/shop-fullwidth', $data);
    }

    public function filter(): string
    {
        $data = [
            'title' => 'Shop Filter - Nest eCommerce',
            'description' => 'Filter our products'
        ];
        return view('pages/shop-filter', $data);
    }
} 