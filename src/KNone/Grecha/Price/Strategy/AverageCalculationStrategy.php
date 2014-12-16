<?php

namespace KNone\Grecha\Price\Strategy;

class AverageCalculationStrategy implements PriceStrategyInterface
{
    /**
     * @var int
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
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->average = $params['average'];
        $this->deviation = $params['deviation'];
        $this->retailRate = $params['retail_rate'];
    }

    /**
     * @return int
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