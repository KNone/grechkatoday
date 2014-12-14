<?php

namespace KNone\Grecha\Entity\Persistence;

use Doctrine\DBAL\Statement;
use Doctrine\DBAL\Types\Type;
use KNone\Grecha\Entity\Common\AbstractRepository;
use KNone\Grecha\Entity\Common\FieldDescription;
use KNone\Grecha\Entity\Price;
use KNone\Grecha\Entity\PriceRepository;

class DbalPriceRepository extends AbstractRepository implements PriceRepository
{
    /**
     * @return Price|null
     */
    public function findActualPrice()
    {
        $date = new \DateTime('today');
        $sql = sprintf('SELECT * FROM %s p WHERE p.date_time <= ? ORDER BY p.date_time DESC LIMIT 1', $this->getTableName());

        /** @var Statement $statement */
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(1, $date, Type::DATETIME);
        $statement->execute();
        $result = $statement->fetchAll();

        if (empty($result)) {
            return null;
        }

        return $this->createEntity($result[0]);
    }

    /**
     * @param \DateTime $dateTime
     * @return Price|null
     */
    public function findPriceByDateTime(\DateTime $dateTime)
    {
        $sql = sprintf('SELECT * FROM %s p WHERE p.date_time = ? LIMIT 1', $this->getTableName());

        /** @var Statement $statement */
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(1, $dateTime, Type::DATETIME);
        $statement->execute();
        $result = $statement->fetchAll();

        if (empty($result)) {
            return null;
        }

        return $this->createEntity($result[0]);
    }

    /**
     * @return string
     */
    protected function getTableName()
    {
        return 'k_prices';
    }

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return 'KNone\Grecha\Entity\Price';
    }

    /**
     * @return FieldDescription[]
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
