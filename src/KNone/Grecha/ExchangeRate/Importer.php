<?php

namespace KNone\Grecha\ExchangeRate;

use KNone\Grecha\Entity\ExchangeRateRepositoryInterface;

class Importer
{
    /**
     * @var XmlRateParser
     */
    private $xmlRateParser;

    /**
     * @var ExchangeRateRepositoryInterface
     */
    private $exchangeRateRepository;

    /**
     * @param XmlRateParser $xmlRateParser
     * @param ExchangeRateRepositoryInterface $exchangeRateRepository
     */
    public function __construct(XmlRateParser $xmlRateParser, ExchangeRateRepositoryInterface $exchangeRateRepository)
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

    /**
     * @param \DateTimeInterface $date
     */
    public function importFromDate(\DateTimeInterface $date)
    {
        $currentDate = new \DateTimeImmutable('today');
        $interval = new \DateInterval('P1D');
        while ($currentDate >= $date) {
            $exchangeRate = $this->exchangeRateRepository->findExchangeRateByDateTime($currentDate);
            if (!$exchangeRate) {
                $exchangeRate = $this->xmlRateParser->getExchangeRateByDate($currentDate);
                $this->exchangeRateRepository->add($exchangeRate);
                $this->exchangeRateRepository->commit();
            }
            $currentDate = $currentDate->sub($interval);
        }
    }
}
