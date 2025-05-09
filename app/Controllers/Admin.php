<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index(): string
    {
        // Carregar os modelos necessários
        $productModel = new \App\Models\ProductModel();
        $categoryModel = new \App\Models\CategoryModel();
        
        // Obter contagens
        $totalProducts = $productModel->countAllResults();
        $activeProducts = $productModel->where('status', 1)->countAllResults();
        $featuredProducts = $productModel->where('featured', 1)->countAllResults();
        $totalCategories = $categoryModel->countAllResults();
        
        // Obter produtos mais recentes
        $recentProducts = $productModel->orderBy('created_at', 'DESC')
                                        ->limit(5)
                                        ->find();
        
        $data = [
            'title' => 'Dashboard - Painel Admin',
            'description' => 'Painel administrativo da loja',
            'totalProducts' => $totalProducts,
            'activeProducts' => $activeProducts,
            'featuredProducts' => $featuredProducts,
            'totalCategories' => $totalCategories,
            'recentProducts' => $recentProducts
        ];
        
        return view('admin/pages/dashboard', $data);
    }
    
    // Products section
    public function products(): string
    {
        $data = [
            'title' => 'Products - Nest Admin',
            'description' => 'Manage your products'
        ];
        
        return view('admin/pages/products', $data);
    }
    
    public function productsGrid(): string
    {
        $data = [
            'title' => 'Product Grid - Nest Admin',
            'description' => 'Products in grid view'
        ];
        
        return view('admin/pages/products-grid', $data);
    }
    
    public function productsGrid2(): string
    {
        $data = [
            'title' => 'Product Grid 2 - Nest Admin',
            'description' => 'Products in alternate grid view'
        ];
        
        return view('admin/pages/products-grid-2', $data);
    }
    
    // Categories section
    public function categories(): string
    {
        $data = [
            'title' => 'Categories - Nest Admin',
            'description' => 'Manage your product categories'
        ];
        
        return view('admin/pages/categories', $data);
    }
    
    // Orders section
    public function orders(): string
    {
        $data = [
            'title' => 'Orders - Nest Admin',
            'description' => 'Manage your orders'
        ];
        
        return view('admin/pages/orders', $data);
    }
    
    public function ordersList2(): string
    {
        $data = [
            'title' => 'Orders List 2 - Nest Admin',
            'description' => 'Alternate orders list view'
        ];
        
        return view('admin/pages/orders-list-2', $data);
    }
    
    public function ordersDetail(): string
    {
        $data = [
            'title' => 'Order Detail - Nest Admin',
            'description' => 'View order details'
        ];
        
        return view('admin/pages/orders-detail', $data);
    }
    
    // Sellers section
    public function sellersCards(): string
    {
        $data = [
            'title' => 'Sellers Cards - Nest Admin',
            'description' => 'View seller cards'
        ];
        
        return view('admin/pages/sellers-cards', $data);
    }
    
    public function sellersList(): string
    {
        $data = [
            'title' => 'Sellers List - Nest Admin',
            'description' => 'View sellers list'
        ];
        
        return view('admin/pages/sellers-list', $data);
    }
    
    public function sellerDetail(): string
    {
        $data = [
            'title' => 'Seller Detail - Nest Admin',
            'description' => 'View seller details'
        ];
        
        return view('admin/pages/seller-detail', $data);
    }
    
    // Add product forms
    public function addProductForm1(): string
    {
        $data = [
            'title' => 'Add Product Form 1 - Nest Admin',
            'description' => 'Add a new product - form 1'
        ];
        
        return view('admin/pages/form-product-1', $data);
    }
    
    public function addProductForm2(): string
    {
        $data = [
            'title' => 'Add Product Form 2 - Nest Admin',
            'description' => 'Add a new product - form 2'
        ];
        
        return view('admin/pages/form-product-2', $data);
    }
    
    public function addProductForm3(): string
    {
        $data = [
            'title' => 'Add Product Form 3 - Nest Admin',
            'description' => 'Add a new product - form 3'
        ];
        
        return view('admin/pages/form-product-3', $data);
    }
    
    public function addProductForm4(): string
    {
        $data = [
            'title' => 'Add Product Form 4 - Nest Admin',
            'description' => 'Add a new product - form 4'
        ];
        
        return view('admin/pages/form-product-4', $data);
    }
    
    // Transactions
    public function transactionsList1(): string
    {
        $data = [
            'title' => 'Transactions List 1 - Nest Admin',
            'description' => 'View transactions'
        ];
        
        return view('admin/pages/transactions-1', $data);
    }
    
    public function transactionsList2(): string
    {
        $data = [
            'title' => 'Transactions List 2 - Nest Admin',
            'description' => 'Alternate transactions view'
        ];
        
        return view('admin/pages/transactions-2', $data);
    }
    
    // Account related
    public function login(): string
    {
        $data = [
            'title' => 'Login - Nest Admin',
            'description' => 'Admin login'
        ];
        
        return view('admin/pages/account-login', $data);
    }
    
    public function register(): string
    {
        $data = [
            'title' => 'Register - Nest Admin',
            'description' => 'Admin registration'
        ];
        
        return view('admin/pages/account-register', $data);
    }
    
    public function error404(): string
    {
        $data = [
            'title' => '404 Not Found - Nest Admin',
            'description' => 'Page not found'
        ];
        
        return view('admin/pages/error-404', $data);
    }
    
    // Other pages
    public function reviews(): string
    {
        $data = [
            'title' => 'Reviews - Nest Admin',
            'description' => 'Manage product reviews'
        ];
        
        return view('admin/pages/reviews', $data);
    }
    
    public function brands(): string
    {
        $data = [
            'title' => 'Brands - Nest Admin',
            'description' => 'Manage product brands'
        ];
        
        return view('admin/pages/brands', $data);
    }
    
    public function blank(): string
    {
        $data = [
            'title' => 'Blank Page - Nest Admin',
            'description' => 'Starter template'
        ];
        
        return view('admin/pages/blank', $data);
    }
} 