<?php

namespace KNone\Grecha\Application\Price;

interface ImporterInterface
{
    /**
     * Import price for the current day
     */
    public function importPrice();

    /**
     * @param  \DateTimeInterface $date
     */
    public function importPriceFromDate(\DateTimeInterface $date);
}
