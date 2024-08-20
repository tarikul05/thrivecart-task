<?php
class Basket {
    private $products;
    private $deliveryRules;
    private $offers;

    public function __construct($products, $deliveryRules, $offers) {
        $this->products = $products;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

}