<?php

namespace KNone\Entity;

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
     * @param $id
     * @param $price
     * @param \DateTime $date
     * @param $description
     */
    public function __construct($id, $price, \DateTime $date, $description)
    {
        $this->id = $id;
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