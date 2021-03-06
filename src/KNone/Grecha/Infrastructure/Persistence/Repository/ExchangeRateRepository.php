<?php

namespace KNone\Grecha\Infrastructure\Persistence\Repository;

use Doctrine\DBAL\Statement;
use Doctrine\DBAL\Types\Type;
use KNone\Grecha\Infrastructure\Persistence\Common\FieldDescription;
use KNone\Grecha\Domain\Model\ExchangeRate;
use KNone\Grecha\Domain\ExchangeRateRepositoryInterface;

class ExchangeRateRepository extends AbstractRepository implements ExchangeRateRepositoryInterface
{
    /**
     * @return ExchangeRate|null
     */
    public function findActualExchangeRate()
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
     * @param \DateTimeInterface $date
     * @return ExchangeRate|null
     */
    public function findExchangeRateByDateTime(\DateTimeInterface $date)
    {
        $sql = sprintf('SELECT * FROM %s p WHERE p.date_time = ? LIMIT 1', $this->getTableName());

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
        return 'k_exchange_rate';
    }

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return ExchangeRate::class;
    }
}
