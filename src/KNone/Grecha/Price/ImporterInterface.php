<?php

namespace KNone\Grecha\Price;

interface ImporterInterface
{
    /**
     * Import price for the current day
     */
    public function importPrice();

    /**
     * @param  \DateTimeInterface $date
     */
    public function importPriceFromDateToToday(\DateTimeInterface $date);
}