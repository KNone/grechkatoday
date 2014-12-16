<?php

namespace KNone\Grecha\Entity;

interface ExchangeRateRepositoryInterface
{
    /**
     * @return ExchangeRate|null
     */
    public function findActualExchangeRate();

    /**
     * @param ExchangeRate $exchangeRate
     */
    public function add($exchangeRate);

    public function commit();
}
