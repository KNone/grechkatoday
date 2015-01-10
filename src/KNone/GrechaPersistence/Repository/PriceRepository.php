<?php

namespace KNone\GrechaPersistence\Repository;

use Doctrine\DBAL\Statement;
use Doctrine\DBAL\Types\Type;
use KNone\GrechaPersistence\Repository\AbstractRepository;
use KNone\GrechaPersistence\Common\FieldDescription;
use KNone\Grecha\Entity\Price;
use KNone\Grecha\Entity\PriceRepositoryInterface;
use KNone\Grecha\Entity\PriceStack;

class PriceRepository extends AbstractRepository implements PriceRepositoryInterface
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
     * @return PriceStack|null
     */
    public function getPriceStack()
    {
        $date = new \DateTime('today');
        $sql = sprintf('SELECT * FROM %s p WHERE p.date_time <= ? ORDER BY p.date_time DESC LIMIT 2', $this->getTableName());

        /** @var Statement $statement */
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(1, $date, Type::DATETIME);
        $statement->execute();
        $result = $statement->fetchAll();

        if (empty($result) || count($result) !== 2) {
            return null;
        }

        $actualPrice = $this->createEntity($result[0]);
        $previousPrice = $this->createEntity($result[1]);

        return new PriceStack($actualPrice, $previousPrice);
    }

    /**
     * @param \DateTimeInterface $dateTime
     * @return Price|null
     */
    public function findPriceByDateTime(\DateTimeInterface $dateTime)
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
     * @return Price[]
     */
    public function findPricesForWeek()
    {
        return $this->findPricesForInterval(new \DateInterval('P6D'));
    }

    /**
     * @return Price[]
     */
    public function findPricesForMonth()
    {
        return $this->findPricesForInterval(new \DateInterval('P1M'));
    }

    /**
     * @param \DateInterval $interval
     * @return Price[]
     */
    private function findPricesForInterval(\DateInterval $interval)
    {
        $today = new \DateTimeImmutable('today');
        $forDate = $today->sub($interval);

        $sql = sprintf('SELECT * FROM %s p WHERE p.date_time >= ? AND p.date_time <= ? ORDER BY p.date_time ASC ', $this->getTableName());
        /** @var Statement $statement */
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(1, $forDate, Type::DATETIME);
        $statement->bindValue(2, $today, Type::DATETIME);
        $statement->execute();
        $results = $statement->fetchAll();

        if (empty($results)) {
            return null;
        }

        $objects = [];
        foreach ($results as $result) {
            $objects[] = $this->createEntity($result);
        }

        return $objects;
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
