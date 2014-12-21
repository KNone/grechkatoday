<?php

namespace KNone\Grecha\ExchangeRate;

use KNone\Grecha\Entity\ExchangeRateRepositoryInterface;

class ExchangeRateConverterFactory
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
     * @return ExchangeRateConverter
     */
    public function createActualExchangeRateConverter()
    {
        return new ExchangeRateConverter($this->exchangeRateRepository->findActualExchangeRate());
    }
}
