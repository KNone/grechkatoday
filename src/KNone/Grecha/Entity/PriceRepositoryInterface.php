<?php

namespace KNone\Grecha\Entity;

interface PriceRepositoryInterface
{
    /**
     * @return Price|null
     */
    public function findActualPrice();

    /**
     * @param \DateTimeInterface $dateTime
     * @return Price|null
     */
    public function findPriceByDateTime(\DateTimeInterface $dateTime);

    /**
     * @param Price $price
     */
    public function add($price);

    public function commit();
}
