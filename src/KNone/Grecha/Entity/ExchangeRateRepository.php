<?php

namespace KNone\Grecha\Entity;

use Doctrine\DBAL\Connection;

class ExchangeRateRepository
{
    private $objectsForPersist = [];

    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return ExchangeRate
     */
    public function getLastExchangeRate()
    {
        // todo
    }

    /**
     * @param ExchangeRate $exchangeRate
     */
    public function add(ExchangeRate $exchangeRate)
    {
        $this->objectsForPersist[] = $exchangeRate;
    }

    public function commit()
    {
        // todo: persist objects
    }
}