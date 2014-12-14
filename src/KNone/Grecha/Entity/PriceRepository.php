<?php

namespace KNone\Grecha\Entity;

interface PriceRepository
{
    /**
     * @return Price|null
     */
    public function findActualPrice();

    /**
     * @param Price $price
     */
    public function add($price);

    public function commit();
}
