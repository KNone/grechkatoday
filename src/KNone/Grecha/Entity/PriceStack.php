<?php

namespace KNone\Grecha\Entity;

class PriceStack
{
    /**
     * @var Price
     */
    private $actualPrice;

    /**
     * @var Price
     */
    private $previousPrice;

    /**
     * @param Price $actualPrice
     * @param Price $previousPrice
     */
    public function __construct(Price $actualPrice, Price $previousPrice)
    {
        $this->actualPrice = $actualPrice;
        $this->previousPrice = $previousPrice;
    }

    /**
     * @return Price
     */
    public function getActualPrice()
    {
        return $this->actualPrice;
    }

    /**
     * @return Price
     */
    public function getPreviousPrice()
    {
        return $this->previousPrice;
    }
}