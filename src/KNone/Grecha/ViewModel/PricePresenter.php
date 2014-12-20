<?php

namespace KNone\Grecha\ViewModel;

use KNone\Grecha\Entity\Price;
use KNone\Grecha\ExchangeRate\ExchangeRateConverter;

class PricePresenter
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
     * @var ExchangeRateConverter
     */
    private $exchangeRateConverter;

    /**
     * @param Price $actualPrice
     * @param Price $previousPrice
     * @param ExchangeRateConverter $exchangeRateConverter
     */
    public function __construct(
        Price $actualPrice,
        Price $previousPrice,
        ExchangeRateConverter $exchangeRateConverter
    ) {

        $this->actualPrice = $actualPrice;
        $this->previousPrice = $previousPrice;
        $this->exchangeRateConverter = $exchangeRateConverter;
    }

    /**
     * @return float
     */
    public function getRubles()
    {
        return $this->actualPrice->getValue();
    }

    /**
     * @return float
     */
    public function getDollars()
    {
        return $this->exchangeRateConverter
            ->convertRoublesToUsd($this->actualPrice->getValue());
    }

    /**
     * @return float
     */
    public function getEuro()
    {
        return $this->exchangeRateConverter
            ->convertRoublesToEur($this->actualPrice->getValue());
    }

    /**
     * @return float
     */
    public function getDifferenceInRubles()
    {
        return $this->actualPrice->getValue() - $this->previousPrice->getValue();
    }
}