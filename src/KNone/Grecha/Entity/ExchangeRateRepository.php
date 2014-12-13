<?php

namespace KNone\Grecha\Entity;

use Doctrine\DBAL\Types\Type;
use KNone\Grecha\Entity\Common\AbstractRepository;
use KNone\Grecha\Entity\Common\FieldDescription;

class ExchangeRateRepository extends AbstractRepository
{
    const TABLE_NAME = 'k_exchange_rate';

    /**
     * @return ExchangeRate
     */
    public function getExchangeRate()
    {
        // todo
    }

    /**
     * @return FieldDescription[]
     */
    protected function getFieldDescriptions()
    {
        return [
            new FieldDescription('id', 'id', Type::INTEGER),
            new FieldDescription('dateTime', 'date_time', Type::DATETIME),
            new FieldDescription('usd', 'usd', Type::FLOAT),
            new FieldDescription('eur', 'eur', Type::FLOAT),
        ];
    }

    /**
     * @return string
     */
    protected function getTableName()
    {
        return self::TABLE_NAME;
    }
}
