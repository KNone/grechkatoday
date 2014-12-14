<?php

namespace KNone\Grecha\Entity;

interface PriceRepository
{
    /**
     * @return Price|null
     */
    public function findActualPrice();

    /**
     * @param \DateTime $dateTime
     * @return Price|null
     */
    public function findPriceByDateTime(\DateTime $dateTime);

    /**
     * @param Price $price
     */
    public function add($price);

    public function commit();
}
