<?php

/**
 * Class Product
 */
class Product
{
    /**
     * Product name
     * @var string
     */
    private $name = '';

    /**
     * Product price
     * @var int
     */
    private $price = 0;

    /**
     * User ID
     * @var string
     */
    private $code = '';

    /**
     * Initialize Product
     * @param $code
     * @param $name
     * @param $price
     */
    public function __construct($code, $name, $price)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * Get product code.
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get product name.
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get product price.
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

}
