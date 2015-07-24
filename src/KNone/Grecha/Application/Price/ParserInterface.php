<?php

namespace KNone\Grecha\Application\Price;

interface ParserInterface
{
    /**
     * @param  \DateTimeInterface $date
     * @return array
     */
	public function getByDate(\DateTimeInterface $date);
}
