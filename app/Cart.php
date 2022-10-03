<?php
/**
 * Cart class to manage the shopping items.
 */

class Cart
{

    /** Contract max count to apply discount */
    const CONTRACT_MAX_COUNT = 12;

    /**
     * Maximum item qty allowed in the cart.
     * @var int
     */
    protected $itemMaxQty = 0;
    /**
     * Enable or disable offer.
     * @var array
     */
    protected $offer = false;
    /**
     * Cart items.
     * @var array
     */
    private $items = [];
    /**
     * Discount
     * @var array
     */
    private $discount = 10;

    /**
     * Initialize cart.
     * @param User $user
     * @param int $itemMaxQty
     */
    public function __construct(User $user, $itemMaxQty)
    {

        if (isset($itemMaxQty) && preg_match('/^\d+$/', $itemMaxQty)) {
            $this->itemMaxQty = $itemMaxQty;
        }
        if ($user->getContractMonth() >= self::CONTRACT_MAX_COUNT) {
            $this->offer = true;
        }

    }

    /**
     * Get cart items.
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }


    /**
     * Get the total of cart item.
     * @return int
     */
    public function getTotalItem()
    {
        $total = 0;

        foreach ($this->items as $item) {
            ++$total;
        }
        return $total;
    }


    /**
     * Get the price total from the cart.
     * @return int
     */
    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $product) {
            $total += $product['item']->getPrice() * $product['quantity'];

        }

        if ($this->offer) {
            $total = $total - ($total * ($this->discount / 100));
        }

        return $total;
    }

    /**
     * Add product to cart.
     * @param Product $product
     * @param int $quantity
     * @return bool
     */
    public function addProduct(Product $product, $quantity)
    {
        $code = $product->getCode();
        $quantity = (preg_match('/^\d+$/', $quantity)) ? $quantity : 1;

        if (isset($this->items[$code])) {
            $this->items[$code]['quantity'] += $quantity;
            $this->items[$code]['quantity'] = ($this->itemMaxQty < $this->items[$code]['quantity'] && $this->itemMaxQty != 0) ? $this->itemMaxQty : $this->items[$code]['quantity'];

            return true;
        }
        if ($quantity > $this->itemMaxQty) {
            print_r($quantity);
            throw new InvalidArgumentException(sprintf(
                'Each individual product can only be added to the cart %s time(s).',
                $this->itemMaxQty
            ));
        }

        $this->items[$code] = [
            'item' => $product,
            'quantity' => ($quantity > $this->itemMaxQty && $this->itemMaxQty != 0) ? $this->itemMaxQty : $quantity
        ];

        return true;
    }
}