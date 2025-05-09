<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

// Shop Routes
$routes->get('/shop', 'Shop::index');
$routes->get('/shop/grid-left', 'Shop::gridLeft');
$routes->get('/shop/list-right', 'Shop::listRight');
$routes->get('/shop/list-left', 'Shop::listLeft');
$routes->get('/shop/fullwidth', 'Shop::fullwidth');
$routes->get('/shop/filter', 'Shop::filter');

// Product Routes
$routes->get('/product/(:any)', 'Product::view/$1');
$routes->get('/product/view/(:any)', 'Product::viewType/$1');

// Cart Routes
$routes->get('/cart', 'Cart::index');
$routes->get('/checkout', 'Cart::checkout');
$routes->get('/wishlist', 'Cart::wishlist');
$routes->get('/compare', 'Cart::compare');

// Account Routes
$routes->get('/account', 'Account::index');
$routes->get('/login', 'Account::login');
$routes->get('/register', 'Account::register');
$routes->get('/logout', 'Account::logout');
$routes->get('/forgot-password', 'Account::forgotPassword');
$routes->get('/reset-password', 'Account::resetPassword');

// Test Routes
$routes->get('/test', 'Test::index');
$routes->get('/test/layout', 'Test::layout');
$routes->get('/test/database', 'Test::database');
$routes->get('/test/session', 'Test::session');
$routes->get('/test/info', 'Test::info');

service('auth')->routes($routes);

// Rotas de autenticação
$routes->get('admin/login', 'Admin\Auth::login');
$routes->post('admin/login', 'Admin\Auth::attemptLogin');
$routes->get('admin/logout', 'Admin\Auth::logout');

// Admin Routes
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    // Dashboard
    $routes->get('/', 'Admin::index');
    
    // Products
    $routes->get('products', 'Admin\Products::index');
    $routes->get('products/create', 'Admin\Products::create');
    $routes->post('products/store', 'Admin\Products::store');
    $routes->get('products/edit/(:num)', 'Admin\Products::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\Products::update/$1');
    $routes->get('products/delete/(:num)', 'Admin\Products::delete/$1');
    $routes->get('products/deleteImage/(:num)', 'Admin\Products::deleteImage/$1');
    $routes->get('products/setPrimaryImage/(:num)', 'Admin\Products::setPrimaryImage/$1');
    
    // Categories
    $routes->get('categories', 'Admin\Categories::index');
    $routes->get('categories/create', 'Admin\Categories::create');
    $routes->post('categories/store', 'Admin\Categories::store');
    $routes->get('categories/edit/(:num)', 'Admin\Categories::edit/$1');
    $routes->post('categories/update/(:num)', 'Admin\Categories::update/$1');
    $routes->get('categories/delete/(:num)', 'Admin\Categories::delete/$1');
    
    // Orders
    $routes->get('orders', 'Admin::orders');
    $routes->get('orders/list-2', 'Admin::ordersList2');
    $routes->get('orders/detail', 'Admin::ordersDetail');
    
    // Sellers
    $routes->get('sellers/cards', 'Admin::sellersCards');
    $routes->get('sellers/list', 'Admin::sellersList');
    $routes->get('sellers/detail', 'Admin::sellerDetail');
    
    // Add Product Forms
    $routes->get('add-product/form-1', 'Admin::addProductForm1');
    $routes->get('add-product/form-2', 'Admin::addProductForm2');
    $routes->get('add-product/form-3', 'Admin::addProductForm3');
    $routes->get('add-product/form-4', 'Admin::addProductForm4');
    
    // Transactions
    $routes->get('transactions/list-1', 'Admin::transactionsList1');
    $routes->get('transactions/list-2', 'Admin::transactionsList2');
    
    // Account
    $routes->get('account/login', 'Admin::login');
    $routes->get('account/register', 'Admin::register');
    $routes->get('error-404', 'Admin::error404');
    
    // Other pages
    $routes->get('reviews', 'Admin::reviews');
    $routes->get('brands', 'Admin::brands');
    
    // Profile
    $routes->get('profile', 'Admin\Profile::index');
    $routes->post('profile/update', 'Admin\Profile::update');
    
    // Blank page
    $routes->get('blank', 'Admin::blank');
});
