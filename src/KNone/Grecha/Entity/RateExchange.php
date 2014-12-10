<?php

namespace KNone\Grecha\Entity;

class RateExchange
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateTime;

    /**
     * @var float
     */
    private $usd;

    /**
     * @var float
     */
    private $eur;

    /**
     * @param \DateTime $dateTime
     * @param float $usd
     * @param float $eur
     */
    function __construct(\DateTime $dateTime, $usd, $eur)
    {
        $this->dateTime = $dateTime;
        $this->usd = $usd;
        $this->eur = $eur;
    }
}