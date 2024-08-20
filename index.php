<?php
require_once 'src/Basket.php';
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

?>
