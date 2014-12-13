<?php

namespace KNone\Grecha\Entity\Common;

use Doctrine\DBAL\Connection;

abstract class AbstractRepository
{
    /**
     * @var array
     */
    protected $objectsForPersist = [];

    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;

    /**
     * @var FieldDescription[]
     */
    protected $fieldDescriptions;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->fieldDescriptions = $this->getFieldDescriptions();
    }

    /**
     * @param $object
     */
    public function add($object)
    {
        $this->objectsForPersist[] = $object;
    }

    public function commit()
    {
        foreach ($this->objectsForPersist as $object) {
            $data = [];
            $types = [];
            foreach ($this->fieldDescriptions as $key => $description) {
                $method = 'get' . ucfirst($description->getPropertyName());
                $data[$description->getFieldName()] = $object->$method();
                $types[] = $description->getType();
            }
            $this->connection->insert($this->getTableName(), $data, $types);
        }
    }

    /**
     * @return FieldDescription[]
     */
    abstract protected function getFieldDescriptions();

    /**
     * @return string
     */
    abstract protected function getTableName();

    protected function createObjectFromAssocArray($result, $className)
    {
        $reflection = new \ReflectionClass($className);
        $object = $reflection->newInstanceWithoutConstructor();

        foreach ($this->fieldDescriptions as $description) {
            $property = $reflection->getProperty($description->getPropertyName());
            $property->setAccessible(true);
            $property->setValue($object, $result[$description->getFieldName()]);
            $property->setAccessible(false);
        }

        return $object;
    }
}
