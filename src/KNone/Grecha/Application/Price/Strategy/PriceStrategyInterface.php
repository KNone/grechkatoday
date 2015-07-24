<?php

namespace KNone\Grecha\Application\Price\Strategy;

interface PriceStrategyInterface
{
    /**
     * @param array $priceList
     * @return float|null
     */
    public function calculate(array $priceList);
}
