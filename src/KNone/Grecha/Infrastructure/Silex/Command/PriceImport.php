<?php

namespace KNone\Grecha\Infrastructure\Silex\Command;

use KNone\Grecha\Application\Price\ImporterInterface;
use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PriceImport extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:import:price')
            ->setDescription('Import price for grecha pf external sources')
            ->addArgument('date', InputArgument::OPTIONAL, null); //Y-m-d
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Import process started');
        $date = $input->getArgument('date');
        /** @var ImporterInterface $importer */
        $importer = $this->getSilexApplication()['grecha.price.importer'];
        if (empty($date)) {
            $importer->importPrice();
        } else {
            $importer->importPriceFromDate(\DateTime::createFromFormat('Y-m-d H:i:s', $date . ' 00:00:00'));
        }
        $output->writeln('Import process finished');

        return 0;
    }
}
