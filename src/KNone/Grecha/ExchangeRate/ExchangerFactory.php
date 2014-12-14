<?php

namespace KNone\Grecha\ExchangeRate;

use KNone\Grecha\Entity\ExchangeRateRepository;

class ExchangerFactory
{
    /**
     * @var ExchangeRateRepository
     */
    private $exchangeRateRepository;

    /**
     * @param ExchangeRateRepository $exchangeRateRepository
     */
    public function __construct(ExchangeRateRepository $exchangeRateRepository)
    {
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    /**
     * @return Exchanger
     */
    public function createActualExchangerRate()
    {
        return new Exchanger($this->exchangeRateRepository->findActualExchangeRate());
    }
}