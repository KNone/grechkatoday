<?php

namespace KNone\Grecha\Application\Price;

use KNone\Grecha\Domain\Model\Price;
use KNone\Grecha\Domain\PriceRepositoryInterface;
use KNone\Grecha\Application\Price\Strategy\PriceStrategyInterface;

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
     * @param PriceRepositoryInterface $priceRepository
     * @param ParserInterface $parser
     * @param PriceStrategyInterface $priceStrategy
     */
    public function __construct(
        PriceRepositoryInterface $priceRepository,
        ParserInterface $parser,
        PriceStrategyInterface $priceStrategy
    ) {
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
    public function importPriceFromDate(\DateTimeInterface $date)
    {
        $currentDate = new \DateTimeImmutable('yesterday');
        $interval = new \DateInterval('P1D');
        while ($currentDate >= $date) {
            $nextDay = $currentDate->add($interval);
            $price = $this->getPriceRepository()->findPriceByDateTime($nextDay);
            if (!$price) {
                $priceValue = $this->getPriceValueByDate($currentDate);
                $this->savePrice($priceValue, $nextDay);
            }
            $currentDate = $currentDate->sub($interval);
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
        } else {
            $actualPrice = $this->getPriceRepository()->findActualPrice();
            $price = new Price($actualPrice->getValue(), $dateTime);
        }

        $this->getPriceRepository()->add($price);
        $this->getPriceRepository()->commit();
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
