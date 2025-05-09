<?php

namespace App\Controllers;

class Cart extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Shopping Cart - Nest eCommerce',
            'description' => 'View your shopping cart'
        ];
        return view('pages/cart', $data);
    }

    public function checkout(): string
    {
        $data = [
            'title' => 'Checkout - Nest eCommerce',
            'description' => 'Complete your order'
        ];
        return view('pages/checkout', $data);
    }

    public function wishlist(): string
    {
        $data = [
            'title' => 'Wishlist - Nest eCommerce',
            'description' => 'View your wishlist'
        ];
        return view('pages/wishlist', $data);
    }

    public function compare(): string
    {
        $data = [
            'title' => 'Compare Products - Nest eCommerce',
            'description' => 'Compare products'
        ];
        return view('pages/compare', $data);
    }
} 