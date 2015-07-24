<?php

namespace KNone\Grecha\Domain;

use KNone\Grecha\Domain\Model\ExchangeRate;

interface ExchangeRateRepositoryInterface extends BaseRepositoryInterface
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
}
