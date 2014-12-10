<?php

namespace KNone\Console\Command;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PriceImport extends Command
{
    protected function configure() 
    {
        $this
            ->setName('app:import:price')
            ->setDescription('Import price for grecha pf external sources');

    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('Import process started');
        //$this->getSilexApplication()
    }
}