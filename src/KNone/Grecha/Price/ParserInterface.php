<?php

namespace KNone\Grecha\Price;

interface ParserInterface
{
    /**
     * @param  \DateTime $date
     * @return array
     */
	public function getByDate(\DateTime $date);
}