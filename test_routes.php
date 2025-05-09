<?php
/**
 * Route Testing Script
 * 
 * This script tests all defined routes in the application to check if they return proper responses.
 * Run this script from the command line: php test_routes.php
 */

// Base URL of your application - change this to match your configuration
$baseUrl = 'http://localhost:8080';

// Define routes to test
$routes = [
    // Core pages
    '' => 'Home page',
    'about' => 'About page',
    'contact' => 'Contact page',
    
    // Shop pages
    'shop' => 'Shop main page',
    'shop/grid-left' => 'Shop grid left page',
    'shop/list-right' => 'Shop list right page',
    'shop/list-left' => 'Shop list left page',
    'shop/fullwidth' => 'Shop fullwidth page',
    'shop/filter' => 'Shop filter page',
    
    // Product pages
    'product/sample-product' => 'Product detail page',
    'product/view/right' => 'Product view right page',
    'product/view/left' => 'Product view left page',
    'product/view/full' => 'Product view full page',
    
    // Cart pages
    'cart' => 'Shopping cart page',
    'checkout' => 'Checkout page',
    'wishlist' => 'Wishlist page',
    'compare' => 'Compare products page',
    
    // Account pages
    'account' => 'Account page',
    'login' => 'Login page',
    'register' => 'Register page',
    
    // Test pages
    'test' => 'Test index page',
    'test/layout' => 'Layout test page',
    'test/database' => 'Database test endpoint',
    'test/session' => 'Session test endpoint',
    'test/info' => 'System info endpoint',
];

// Function to test a route
function testRoute($baseUrl, $route, $description) {
    $url = rtrim($baseUrl, '/') . '/' . $route;
    
    echo "Testing: {$description} ({$url})... ";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        echo "ERROR: {$error}\n";
        return false;
    }
    
    if ($httpCode >= 200 && $httpCode < 300) {
        echo "SUCCESS ({$httpCode})\n";
        return true;
    } else {
        echo "FAILED ({$httpCode})\n";
        return false;
    }
}

// Run the tests
echo "=== Route Testing Report ===\n";
echo "Testing routes against base URL: {$baseUrl}\n\n";

$passCount = 0;
$failCount = 0;

foreach ($routes as $route => $description) {
    if (testRoute($baseUrl, $route, $description)) {
        $passCount++;
    } else {
        $failCount++;
    }
}

echo "\n=== Test Summary ===\n";
echo "Total routes tested: " . count($routes) . "\n";
echo "Passed: {$passCount}\n";
echo "Failed: {$failCount}\n";

if ($failCount == 0) {
    echo "\nAll routes are working correctly!\n";
} else {
    echo "\nSome routes failed. Please check the output above for details.\n";
} 