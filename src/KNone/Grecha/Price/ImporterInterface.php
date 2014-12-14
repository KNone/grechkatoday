<?php

namespace KNone\Grecha\Price;

interface ImporterInterface
{
    public function importPrice();

    public function importPriceFromDateToToday(\DateTimeInterface $date);
}