<?php

namespace KNone\Grecha\Infrastructure\Silex\View;

class Helper
{
    /**
     * @return string
     */
    public function getDateEnds()
    {
        $date = date('d');
        $ends = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
        if (($date % 100) >= 11 && ($date % 100) <= 13) {
            return 'th';
        } else {
            return $ends[$date % 10];
        }
    }
}
