<?php

namespace KNone\Grecha\Infrastructure\Silex\Command;

use KNone\Grecha\Application\ExchangeRate\Importer;
use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExchangeRateImport extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:import:exchange-rate')
            ->setDescription('Import exchange rates')
            ->addArgument('date', InputArgument::OPTIONAL, null); //Y-m-d;
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
        $output->writeln('Import process started');
        $date = $input->getArgument('date');

        if (empty($date)) {
            $importer->import();
        } else {
            $importer->importFromDate(\DateTime::createFromFormat('Y-m-d H:i:s', $date . ' 00:00:00'));
        }
        $output->writeln('Import process finished');

        return 0;
    }
}
