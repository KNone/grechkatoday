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
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
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
            $fieldDescriptions = $this->getFieldDescriptions();
            foreach ($fieldDescriptions as $key => $description) {
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
}
