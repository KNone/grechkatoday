<?php

namespace KNone\Grecha\Entity\Common;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Type;

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

    /**
     * @return string
     */
    abstract protected function getEntityName();

    /**
     * @param  array  $result
     * @param  string $className Entity class name
     * @return object
     */
    protected function createObjectFromAssocArray(array $result, $className)
    {
        $injectValue = function($fieldDescriptions, $result) {
            foreach ($fieldDescriptions as $description) {
                $this->{$description->getPropertyName()} = $result[$description->getFieldName()];
            }
        };

        $object = (new \ReflectionClass($className))->newInstanceWithoutConstructor();
        $injectValue = $injectValue->bindTo($object, $object);
        $result = $this->prepareValueFromAssocArray($result);
        $injectValue($this->fieldDescriptions, $result);

        return $object;
    }

    /**
     * Create entity, fields value of which containing value of $result
     *
     * @param  array  $result [description]
     * @return object
     */
    protected function createEntity(array $result)
    {
        return $this->createObjectFromAssocArray($result, $this->getEntityName());
    }

    /**
     * @param  array  $result
     * @return array
     */
    protected function prepareValueFromAssocArray(array $result)
    {
        foreach ($this->fieldDescriptions as $description) {
            $fieldName = $description->getFieldName();
            $result[$fieldName] = $this->prepareValue($result[$fieldName], $description->getType());
        }

        return $result;
    }

    /**
     * Prepare db types for php
     *
     * @param  mixed  $value
     * @param  string $type
     * @return mixed
     */
    protected function prepareValue($value, $type)
    {
        if ($type === Type::DATETIME) {
            $value = new \DateTime($value);
        }

        return $value;
    }
}
