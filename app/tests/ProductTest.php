<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Cart.php';
require_once __DIR__ . '/../Product.php';

/**
 * Class ProductTest
 */
class ProductTest extends TestCase
{
    /**
     *
     */
    public function testProductConstructorAndGetter()
    {
        $product = new Product('P001', 'Photography', 200);
        $this->assertEquals('P001', $product->getCode());
        $this->assertEquals('Photography', $product->getName());
        $this->assertEquals(200, $product->getPrice());
    }

}