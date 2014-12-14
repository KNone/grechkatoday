<?php

namespace KNone\Grecha\Price;

interface ParserInterface
{
    /**
     * @param  \DateTimeInterface $date
     * @return array
     */
	public function getByDate(\DateTimeInterface $date);
}