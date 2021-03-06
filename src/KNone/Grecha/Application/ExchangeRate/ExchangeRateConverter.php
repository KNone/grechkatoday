<?php

namespace KNone\Grecha\Application\ExchangeRate;

use KNone\Grecha\Domain\Model\ExchangeRate;

class ExchangeRateConverter
{
    /**
     * @var ExchangeRate
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
    public function convertRoublesToUsd($value)
    {
        return round($value / $this->exchangeRate->getUsd(), 2);
    }

    /**
     * @param float $value
     * @return float
     */
    public function convertRoublesToEur($value)
    {
        return round($value / $this->exchangeRate->getEur(), 2);
    }
}
