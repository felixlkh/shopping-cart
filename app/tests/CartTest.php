<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Cart.php';
require_once __DIR__ . '/../Product.php';
require_once __DIR__ . '/../User.php';


/**
 * Class CartTest
 */
class CartTest extends TestCase
{
    /**
     * @var Cart|null
     */
    private $cart = null;

    /**
     * @var array|Product[]
     */
    private $products = [];

    /**
     *
     */
    public function setUp(): void
    {
        $itemMaxQTY=1;
        $user = new User('U001','Sam','1');
        $this->cart = new Cart($user,$itemMaxQTY);
        $this->products = [
            new Product('P001', 'Photography', 200),
            new Product('P002', 'Floorplan', 100),
            new Product('P003', 'Gas Certificate', 83.50),
            new Product('P004', 'EICR Certificate', 51.00)
        ];
    }

    /**
     *
     */
    public function tearDown(): void
    {
        $this->cart = null;
        $this->products = [];
    }


    /**
     *  Add a Product
     */
    public function testAddOneProudct()
    {
        $this->cart->addProduct($this->products[0],1);
        $this->assertEquals(1, $this->cart->getTotalItem());

    }

    /**
     *  Add all product
     */
    public function testAddAllProduct()
    {
        foreach ($this->products as $p){
            $this->cart->addProduct($p,1);
        }

        $this->assertEquals(4, $this->cart->getTotalItem());
    }

    /**
     * Add individual product more then once
     */
    public function testAddIndividualProductMoreThenOnce()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Each individual product can only be added to the cart 1 time(s).');
        $this->cart->addProduct($this->products[0],2);

    }

    /**
     *  Test User with 12 month contract
     */
    public function testUserDiscountWith12MonthContract()
    {

        $user = new User('U001','Amy','12');
        $this->cart = new Cart($user,'1');

        foreach ($this->products as $p){
            $this->cart->addProduct($p,1);
        }

        $this->assertEquals(391.05, $this->cart->getTotal());
    }

    /**
     *  Test User with 3 month contract
     */
    public function testUserDiscountWith3MonthContract()
    {

        $user = new User('U001','Amy','3');
        $this->cart = new Cart($user,'1');

        foreach ($this->products as $p){
            $this->cart->addProduct($p,1);
        }

        $this->assertEquals(434.5, $this->cart->getTotal());
    }
}