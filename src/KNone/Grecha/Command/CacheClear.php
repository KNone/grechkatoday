<?php

namespace KNone\Grecha\Command;

use KNone\Grecha\Price\ImporterInterface;
use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class CacheClear extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:cache:clear')
            ->setDescription('Clear application cache');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {     
        $fs = new Filesystem();
        $rootDir = $this->getSilexApplication()['root_dir'].'/';
        $cacheDirs = $this->getSilexApplication()['config']['cache']['dir'];

        foreach ($cacheDirs as $cacheName => $cacheDir) {
            $cacheDir = $rootDir.$cacheDir;

            if ($fs->exists($cacheDir)) {
                $fs->remove($cacheDir);
                $output->writeln(sprintf('Clear %s cache (%s)', $cacheName, $cacheDir));
            } else {
                $output->writeln(sprintf('Skip %s cache (%s)', $cacheName, $cacheDir));
            }
        }

        $output->writeln('Chache clear finished');


        return 0;
    }
}
