<?php

namespace KNone\Grecha\Entity;

interface ExchangeRateRepositoryInterface
{
    /**
     * @return ExchangeRate|null
     */
    public function findActualExchangeRate();

    /**
     * @param \DateTimeInterface $dateTime
     * @return ExchangeRate|null
     */
    public function findExchangeRateByDateTime(\DateTimeInterface $dateTime);

    /**
     * @param ExchangeRate $exchangeRate
     */
    public function add($exchangeRate);

    public function commit();
}
