<?php

namespace KNone\Grecha\Command;

use KNone\Grecha\ExchangeRate\Importer;
use Knp\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExchangeRateImport extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:import:exchange-rate')
            ->setDescription('Import exchange rates');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Importer $importer */
        $importer = $this->getSilexApplication()['grecha.exchange_rate.importer'];
        $importer->import();

        return 0;
    }
}