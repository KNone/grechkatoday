<?php

namespace KNone\Grecha\Domain;

interface BaseRepositoryInterface
{
    /**
     * @param $entity
     */
    public function add($entity);

    public function commit();
}
