<?php

namespace KNone\Grecha\Entity;

interface PriceRepository
{
    /**
     * @return Price|null
     */
    public function findActualPrice();

    /**
     * @param Price $exchangeRate
     */
    public function add($exchangeRate);

    public function commit();
}
