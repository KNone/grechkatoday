<?php

namespace KNone\Grecha\Price;

use KNone\Grecha\Entity\Price;
use KNone\Grecha\Entity\PriceRepositoryInterface;
use KNone\Grecha\Price\Strategy\PriceStrategyInterface;

class Importer implements ImporterInterface
{
    /**
     * @var PriceRepositoryInterface
     */
    private $priceRepository;

    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var PriceStrategyInterface
     */
    private $priceStrategy;

    /**
     * @param object $priceRepository
     * @param ParserInterface $parser
     * @param PriceStrategyInterface $priceStrategy
     */
    public function __construct($priceRepository, ParserInterface $parser, PriceStrategyInterface $priceStrategy)
    {
        $this->priceRepository = $priceRepository;
        $this->parser = $parser;
        $this->priceStrategy = $priceStrategy;
    }

    /**
     * {@inheritdoc}
     */
    public function importPrice()
    {
        $today = new \DateTimeImmutable('today');
        $price = $this->getPriceRepository()->findPriceByDateTime($today);
        if (!$price) {
            $priceValue = $this->getPriceValueByDate(new \DateTimeImmutable('yesterday'));
            $this->savePrice($priceValue, $today);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function importPriceFromDateToToday(\DateTimeInterface $date)
    {
        $currentDate = new \DateTimeImmutable('yesterday');
        while ($currentDate >= $date) {
            $nextDay = $currentDate->add(new \DateInterval('P1D'));
            $price = $this->getPriceRepository()->findPriceByDateTime($nextDay);
            if (!$price) {
                $priceValue = $this->getPriceValueByDate($currentDate);
                $this->savePrice($priceValue, $nextDay);
            }
            $currentDate = $currentDate->sub(new \DateInterval('P1D'));
        }
    }

    /**
     * @param float $value
     * @param \DateTimeInterface $dateTime
     */
    private function savePrice($value, \DateTimeInterface $dateTime)
    {
        if ($value) {
            $price = new Price($value, $dateTime);
            $this->getPriceRepository()->add($price);
            $this->getPriceRepository()->commit();
        } else {
            $price = $this->getPriceRepository()->findPriceByDateTime($dateTime->sub(new \DateInterval('P1D')));
            if ($price) {
                $value = $price->getValue();
                $random = (rand(0, 1) + rand(1, 10) / 10);
                if (rand(0, 1) === 1) {
                    $value = $value - $random;
                } else {
                    $value = $value + $random;
                }

                $this->getPriceRepository()->add(new Price($value, $dateTime));
                $this->getPriceRepository()->commit();
            }
        }
    }

    /**
     * @param \DateTimeInterface $dateTime
     * @return float|null
     */
    private function getPriceValueByDate(\DateTimeInterface $dateTime)
    {
        $prices = $this->getParser()->getByDate($dateTime);

        return $this->getPriceStrategy()->calculate($prices);
    }

    /**
     * @return PriceRepositoryInterface
     */
    private function getPriceRepository()
    {
        return $this->priceRepository;
    }

    /**
     * @return Parser
     */
    private function getParser()
    {
        return $this->parser;
    }

    /**
     * @return Strategy\PriceStrategyInterface
     */
    private function getPriceStrategy()
    {
        return $this->priceStrategy;
    }
}
