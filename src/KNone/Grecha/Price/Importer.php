<?php

namespace KNone\Grecha\Price;

use KNone\Grecha\Price\ParserInterface;
use KNone\Grecha\Price\ImporterInterface;
use KNone\Grecha\Price\Strategy\PriceStrategyInterface as StrategyInterface;

class Importer implements ImporterInterface
{
    /**
     * @var 
     */
    protected $priceRepository;

    /**
     * @var Pareser
     */
    protected $parser;

    protected $strategy;

    /**
     * Create new instance
     *
     * @param object          $priceRepository
     * @param ParserInterface $parser
     */
    public function __construct($priceRepository, ParserInterface $parser/*, StrategyInterface $priceStrategy*/)
    {
        $this->priceRepository = $priceRepository;
        $this->parser = $parser;
        $this->strategy = $priceStrategy;
    }

    /**
     * @return object
     */
    protected function getPriceRepository()
    {
        return $this->priceRepository;
    }

    /**
     * @return Pareser
     */
    protected function getParser()
    {
        return $this->parser;
    }

    protected function getPriceStrategy()
    {
        return $this->priceStrategy;
    }

    /**
     * @param  array  $priceList
     * @return int
     */
    protected function calculatePrice(array $priceList)
    {
        return $this->getPriceStrategy()->calculate($priceList);
    }

    /**
     * {@inheritdoc}
     */
    public function importPrice()
    {
        $yesterday = date('d-m-Y', strtotime('-1 days'));
        $price = $this->getParser()->getByDate(new \DateTime($yesterday));
        $price = $this->calculatePrice($price);
        //save in storage
    }

    /**
     * {@inheritdoc}
     */
    public function importPriceByDate(\DateTime $date)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function importPriceByDateInterval(\DateInterval $interval)
    {

    }
}