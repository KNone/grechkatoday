<?php

namespace KNone\Grecha\Entity;

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
     * @var \DateTime
     */
    private $dateTime;

    /**
     * @param float $value
     * @param \DateTime $dateTime
     */
    public function __construct($value, \DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
        $this->value = $value;
    }

    /**
     * @return \DateTime
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
