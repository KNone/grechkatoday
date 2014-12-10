<?php

namespace KNone\Grecha\Entity;

/**
 * @deprecated
 */
class Price
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $price;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $description;

    /**
     * @param float $price
     * @param \DateTime $date
     * @param string $description
     */
    public function __construct($price, \DateTime $date, $description)
    {
        $this->price = $price;
        $this->date = $date;
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
    public function getPrice()
    {
        return $this->price;
    }
}