<?php

namespace KNone\Grecha\Price;

interface ImporterInterface
{
    public function importPrice();

    public function importPriceByDate(\DateTime $date);

    public function importPriceByDateInterval(\DateInterval $interval);
}