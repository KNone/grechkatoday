<?php

namespace KNone\Grecha\Price\Strategy;

interface PriceStrategyInterface
{
    /**
     * @param array $priceList
     * @return float|null
     */
    public function calculate(array $priceList);
}