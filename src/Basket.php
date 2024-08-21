<?php
namespace App;

/**
 * Basket class
 * 
 * This class is responsible for managing the basket of products.
 * It allows adding products to the basket and calculating the total price.
 * 
 * @package App
 */

class Basket {
    private array $products;
    private array $deliveryRules;
    private array $offers;
    private array $basket;

    /**
     * @param array $products
     * @param array $deliveryRules
     * @param array $offers
     * @return void
     */

    public function __construct( $products, $deliveryRules, $offers) 
    {
        $this->products = $products;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
        $this->basket = [];
    }

    /**
     * @param string $productCode
     * @return void
     */

    public function add(string $productCode): void
    {
        $this->basket[] = $productCode;
    }


    /**
     * @return array<array>
     */
    public function getBasket(): array
    {
        return $this->basket;
    }

    
    /**
     * calculate the total price of the basket considering the offers and delivery rules
     * @return float
     */
    public function total(): float
    {
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

        if (count($productCounts )== 0) return 0;
        
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
        // total to 2 decimal places without considaring rounding
        $total = (int)(($subtotal + $deliveryCost)*100)/100;
        return  $total;
    }

}

?>