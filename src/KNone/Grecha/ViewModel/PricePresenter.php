<?php

namespace KNone\Grecha\ViewModel;

use KNone\Grecha\Entity\PriceStack;
use KNone\Grecha\ExchangeRate\ExchangeRateConverter;

class PricePresenter
{
    /**
     * @var ExchangeRateConverter
     */
    private $exchangeRateConverter;
    /**
     * @var PriceStack
     */
    private $priceStack;

    /**
     * @param PriceStack $priceStack
     * @param ExchangeRateConverter $exchangeRateConverter
     */
    public function __construct(
        PriceStack $priceStack,
        ExchangeRateConverter $exchangeRateConverter
    ) {
        $this->exchangeRateConverter = $exchangeRateConverter;
        $this->priceStack = $priceStack;
    }

    /**
     * @return float
     */
    public function getRubles()
    {
        return $this->priceStack->getActualPrice()->getValue();
    }

    /**
     * @return float
     */
    public function getDollars()
    {
        return $this->exchangeRateConverter
            ->convertRoublesToUsd($this->priceStack->getActualPrice()->getValue());
    }

    /**
     * @return float
     */
    public function getEuro()
    {
        return $this->exchangeRateConverter
            ->convertRoublesToEur($this->priceStack->getActualPrice()->getValue());
    }

    /**
     * @return float
     */
    public function getDifferenceInRubles()
    {
        return round(
            $this->priceStack->getActualPrice()->getValue() - $this->priceStack->getPreviousPrice()->getValue(),
            2
        );
    }
}