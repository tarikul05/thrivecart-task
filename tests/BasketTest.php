<?php
namespace Tests;
use App\Basket;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    // define default products, delivery rules and offers for testing
    private $products = [
        'R01' => 32.95,
        'G01' => 24.95,
        'B01' => 7.95,
    ];
    
    private $deliveryRules = [
        ['threshold' => 50, 'cost' => 4.95],
        ['threshold' => 90, 'cost' => 2.95],
        ['threshold' => PHP_INT_MAX, 'cost' => 0.00]
    ];

    private $offers = [
        'R01' => ['type' => 'B1G1_half_off'],
    ];

    public function testTotalValidateFromGivenSample()
    {
        

        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);

        // Example basket 1: B01, G01
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(37.85, $basket->total());

        // Reset the basket for the next example
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);

        // Example basket 2: R01, R01
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.37, $basket->total());

        // Reset the basket for the next example
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);

        // Example basket 3: R01, G01
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals(60.85, $basket->total());

        // Reset the basket for the next example
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);

        // Example basket 4: B01, B01,  R01, R01, R01 
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(98.27, $basket->total());
    }

    public function testAddFunctoinValidate()
    {
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $this->assertEquals([], $basket->getBasket());

        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(['B01', 'G01'], $basket->getBasket());

        $basket->add('R01');
        $this->assertEquals(['B01', 'G01', 'R01'], $basket->getBasket());

        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $this->assertEquals([], $basket->getBasket());
    }

    public function testTotalWithNoProduct()
    {
        $basket = new Basket($this->products , $this->deliveryRules, $this->offers);
        $this->assertEquals(0, $basket->total());
    }

    public function testTotalWithNoOffer()
    {
        $basket = new Basket($this->products , $this->deliveryRules, []);
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(7.95 + 24.95 + 4.95, $basket->total());

        $basket = new Basket($this->products , $this->deliveryRules, []);
        $basket->add('B01');
        $basket->add('B01');
        $this->assertEquals(7.95 * 2 + 4.95, $basket->total());

        $basket = new Basket($this->products , $this->deliveryRules, []);
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(68.85, $basket->total());
    }

    public function testTotalWithNoDeliveryRule()
    {
        $basket = new Basket($this->products , [], $this->offers);
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(7.95 + 24.95, $basket->total());

        $basket = new Basket($this->products , [], $this->offers);
        $basket->add('B01');
        $basket->add('B01');
        $this->assertEquals(7.95 * 2, $basket->total());

        $basket = new Basket($this->products , [], $this->offers);
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(32.95+16.47 , $basket->total());
    }

    public function testTotalWithNoOfferAndNoDeliveryRule()
    {
        $basket = new Basket($this->products , [], []);
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(7.95 + 24.95, $basket->total());

        $basket = new Basket($this->products , [], []);
        $basket->add('B01');
        $basket->add('B01');
        $this->assertEquals(7.95 * 2, $basket->total());

        $basket = new Basket($this->products , [], []);
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(32.95 * 2, $basket->total());   

    }

    public function testTotalWithNoOfferAndNoDeliveryRuleAndNoProduct()
    {
        $basket = new Basket([], [], []);
        $this->assertEquals(0, $basket->total());
    }

    public function testTotalWithNoOfferAndNoDeliveryRuleAndNoProductAndAddProduct()
    {
        $basket = new Basket([], [], []);
        $basket->add('B01');
        $this->assertEquals(0, $basket->total());
    }

    // test case for constructor
    public function testConstructor()
    {
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $this->assertInstanceOf(Basket::class, $basket);
    }

}
?>
