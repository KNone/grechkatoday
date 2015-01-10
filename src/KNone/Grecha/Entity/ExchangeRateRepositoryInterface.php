<?php

namespace KNone\Grecha\Entity;

use KNone\Grecha\Entity\BaseRepositoryInterface;

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
