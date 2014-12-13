<?php

namespace KNone\Grecha\Command;

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

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Import process started');

        $importer = $this->getSilexApplication()['price.importer'];
        $result = $importer->importPrice();

        $output->writeln('Import process finished');

        return 0;
    }
}