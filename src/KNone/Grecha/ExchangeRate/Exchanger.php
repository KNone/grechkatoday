<?php

namespace KNone\Grecha\ExchangeRate;

use KNone\Grecha\Entity\ExchangeRate;

class Exchanger
{
    /**
     * @var \KNone\Grecha\Entity\ExchangeRate
     */
    private $exchangeRate;

    /**
     * @param ExchangeRate $exchangeRate
     */
    public function __construct(ExchangeRate $exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * @param float $value
     * @return float
     */
    public function exchangeToUsd($value)
    {
        return round($value / $this->exchangeRate->getUsd(), 2);
    }

    /**
     * @param float $value
     * @return float
     */
    public function exchangeToEur($value)
    {
        return round($value / $this->exchangeRate->getEur(), 2);
    }
}