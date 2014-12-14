<?php

namespace KNone\Grecha\Price\Strategy;

class PriceStrategy implements PriceStrategyInterface
{
    const AVERAGE = 60;
    const DEVIATION = 0.6;

    const RETAIL_RATE = 0.5;

    /**
     * @param array $priceList
     * @return float|null
     */
    public function calculate(array $priceList)
    {
        $price = null;
        $sum = 0;
        $count = 0;
        $min = $this->getMin();
        $max = $this->getMax();
        foreach ($priceList as $value) {
            if ($value > $min && $value < $max) {
                $sum += $value;
                $count++;
            }
        }
        if ($count > 0) {
            $price = $sum / $count;
            $price = $price + $price * self::RETAIL_RATE;
        }

        return $price;
    }

    /**
     * @return float
     */
    private function getMax()
    {
        return self::AVERAGE + self::AVERAGE * self::DEVIATION;
    }

    /**
     * @return float
     */
    private function getMin()
    {
        return self::AVERAGE - self::AVERAGE * self::DEVIATION;
    }
}