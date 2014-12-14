<?php

namespace KNone\Grecha\ExchangeRate;

use KNone\Grecha\Entity\ExchangeRateRepository;

class Importer
{
    /**
     * @var XmlRateParser
     */
    private $xmlRateParser;

    /**
     * @var ExchangeRateRepository
     */
    private $exchangeRateRepository;

    /**
     * @param XmlRateParser $xmlRateParser
     * @param ExchangeRateRepository $exchangeRateRepository
     */
    public function __construct(XmlRateParser $xmlRateParser, ExchangeRateRepository $exchangeRateRepository)
    {
        $this->xmlRateParser = $xmlRateParser;
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    public function import()
    {
        $dateTime = new \DateTime('today');
        $actualExchangeRate = $this->exchangeRateRepository->findActualExchangeRate();

        if (!$actualExchangeRate || $actualExchangeRate->getDateTime() != $dateTime) {
            $exchangeRate = $this->xmlRateParser->getExchangeRateByDate($dateTime);

            $this->exchangeRateRepository->add($exchangeRate);
            $this->exchangeRateRepository->commit();
        }
    }
}