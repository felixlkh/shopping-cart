<?php

class User
{
    /**
     * Name of User
     * @var string
     */
    private $name = '';

    /**
     * Contract Month
     * @var int
     */
    private $contract_month = 1;

    /**
     * User ID
     * @var int
     */
    private $user_id = '';

    /**
     * Initialize user.
     * @param string $code
     * @param string $name
     * @param int $contract_month
     */
    public function __construct($user_id, $name, $contract_month)
    {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->contract_month = $contract_month;
    }

    /**
     * Get user code.
     * @return int
     */
    public function getCode()
    {
        return $this->user_id;
    }

    /**
     * Get user name.
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get user contract month.
     * @return int
     */
    public function getContractMonth()
    {
        return $this->contract_month;
    }

}
