<?php

namespace KNone\Grecha\Entity;

use Doctrine\DBAL\Types\Type;
use KNone\Grecha\Entity\Common\AbstractRepository;
use KNone\Grecha\Entity\Common\FieldDescription;

class PriceRepository extends AbstractRepository
{
    const TABLE_NAME = 'k_prices';


    public function getActualPrice()
    {
        // todo
    }

    /**
     * @return string
     */
    protected function getTableName()
    {
        return self::TABLE_NAME;
    }

    /**
     * @return array|Common\FieldDescription[]
     */
    protected function getFieldDescriptions()
    {
        return [
            new FieldDescription('id', 'id', Type::INTEGER),
            new FieldDescription('dateTime', 'date_time', Type::DATETIME),
            new FieldDescription('value', 'value', Type::FLOAT),
        ];
    }
}
