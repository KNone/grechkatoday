<?php

namespace KNone\Grecha\Domain\Model;

class Price
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $value;

    /**
     * @var \DateTimeInterface
     */
    private $dateTime;

    /**
     * @param float $value
     * @param \DateTimeInterface $dateTime
     */
    public function __construct($value, \DateTimeInterface $dateTime)
    {
        $this->dateTime = $dateTime;
        $this->value = $value;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}
