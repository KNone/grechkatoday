<?php

namespace KNone\Grecha\Application\Price\Strategy;

class AverageCalculationStrategy implements PriceStrategyInterface
{
    /**
     * @var float
     */
    private $average;

    /**
     * @var float
     */
    private $deviation;

    /**
     * @var float
     */
    private $retailRate;

    /**
     * @param float $average
     * @param float $deviation
     * @param float $retailRate
     */
    public function __construct($average, $deviation, $retailRate)
    {
        $this->average = $average;
        $this->deviation = $deviation;
        $this->retailRate = $retailRate;
    }

    /**
     * @return float
     */
    protected function getAverage()
    {
        return $this->average;
    }

    /**
     * @return float
     */
    protected function getDeviation()
    {
        return $this->deviation;
    }

    /**
     * @return float
     */
    protected function getRetailRate()
    {
        return $this->retailRate;
    }

    /**
     * @param float[] $priceList
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
            $price = $price + $price * $this->getRetailRate();
        }

        return $price;
    }

    /**
     * @return float
     */
    private function getMax()
    {
        return $this->getAverage() + $this->getAverage() * $this->getDeviation();
    }

    /**
     * @return float
     */
    private function getMin()
    {
        return $this->getAverage() - $this->getAverage() * $this->getDeviation();
    }
}
