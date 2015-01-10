<?php

namespace KNone\Grecha\Entity;

interface BaseRepositoryInterface
{
    /**
     * @param $entity
     */
    public function add($entity);

    public function commit();
}
