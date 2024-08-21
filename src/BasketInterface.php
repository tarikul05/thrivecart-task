<?php
namespace App;

interface BasketInterface {
    public function add(string $productCode);
    public function total(): float;
}

?>
