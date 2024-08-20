<?php
class Basket {
    private $products;
    private $deliveryRules;
    private $offers;
    private $basket;

    public function __construct($products, $deliveryRules, $offers) {
        $this->products = $products;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
        $this->basket = [];
    }

    public function add($productCode) {
        $this->basket[] = $productCode;
    }

    public function total() {
        $subtotal = 0;
        $productCounts = [];

        // Calculate subtotal and count products
        foreach ($this->basket as $code) {
            if (!isset($productCounts[$code])) {
                $productCounts[$code] = 0;
            }
            $productCounts[$code]++;
            $subtotal += $this->products[$code];
        }
        
        // Apply offers over subtotal price
        foreach ($productCounts as $code => $count) {
            if (isset($this->offers[$code])) {
                $offer = $this->offers[$code];
                if ($offer['type'] == 'B1G1_half_off' && $count >= 2) {
                    $subtotal -= $this->products[$code] * 0.5 * floor($count / 2);
                }
            }
        }

        // Determine delivery cost
        $deliveryCost = 0;
        foreach ($this->deliveryRules as $rule) {
            if ($subtotal < $rule['threshold']) {
                $deliveryCost = $rule['cost'];
                break;
            }
        }
        // total to 2 decimal places without considring rounding
        $total = ($subtotal + $deliveryCost)*100;
        return (int) $total / 100;
    }

}


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

?>