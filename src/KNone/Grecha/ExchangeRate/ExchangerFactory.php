<?php

namespace KNone\Grecha\ExchangeRate;

use KNone\Grecha\Entity\ExchangeRateRepositoryInterface;

class ExchangerFactory
{
    /**
     * @var ExchangeRateRepositoryInterface
     */
    private $exchangeRateRepository;

    /**
     * @param ExchangeRateRepositoryInterface $exchangeRateRepository
     */
    public function __construct(ExchangeRateRepositoryInterface $exchangeRateRepository)
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