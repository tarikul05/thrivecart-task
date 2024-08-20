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

        // Determine delivery cost
        $deliveryCost = 0;
        foreach ($this->deliveryRules as $rule) {
            if ($subtotal < $rule['limit']) {
                $deliveryCost = $rule['cost'];
                break;
            }
        }

        return round($subtotal + $deliveryCost, 2);
    }

}