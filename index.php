<?php
require 'vendor/autoload.php';
use App\Basket;

// Define products
$products = [
    'R01' => 32.95,
    'G01' => 24.95,
    'B01' => 7.95
];

// Define delivery charge rules
$deliveryRules = [
    ['threshold' => 50, 'cost' => 4.95],
    ['threshold' => 90, 'cost' => 2.95],
    ['threshold' => PHP_INT_MAX, 'cost' => 0.00]
];

// Define offers
$offers = [
    'R01' => ['type' => 'B1G1_half_off'],
];

// Initialize the basket
$basket = new Basket($products, $deliveryRules, $offers);


// Example basket 1: B01, G01
$basket->add('B01');
$basket->add('G01');
echo $basket->total();  // Expected: $37.85
echo "\n";

// Reset the basket for the next example
$basket = new Basket($products, $deliveryRules, $offers);

// Example basket 2: R01, R01
$basket->add('R01');
$basket->add('R01');
echo $basket->total();  // Expected: $54.37
echo "\n";

// Reset the basket for the next example
$basket = new Basket($products, $deliveryRules, $offers);

// Example basket 3: R01, G01
$basket->add('R01');
$basket->add('G01');
echo $basket->total();  // Expected: $60.85
echo "\n";

// Reset the basket for the next example
$basket = new Basket($products, $deliveryRules, $offers);

// Example basket 4: B01, B01, R01, R01, R01
$basket->add('B01');
$basket->add('B01');
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');
echo $basket->total();  // Expected: $98.27
echo "\n";


$basket = new Basket($products, $deliveryRules, $offers);
echo $basket->total();  // Expected: $0.00
echo "\n";
?>
