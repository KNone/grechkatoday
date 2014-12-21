<?php

namespace KNone\Grecha\Entity;

interface PriceRepositoryInterface
{
    /**
     * @return Price|null
     */
    public function findActualPrice();

    /**
     * @return PriceStack
     */
    public function getPriceStack();

    /**
     * @param \DateTimeInterface $dateTime
     * @return Price|null
     */
    public function findPriceByDateTime(\DateTimeInterface $dateTime);

    /**
     * @return Price[]
     */
    public function findPricesForWeek();

    /**
     * @return Price[]
     */
    public function findPricesForMonth();

    /**
     * @param Price $price
     */
    public function add($price);

    public function commit();
}
