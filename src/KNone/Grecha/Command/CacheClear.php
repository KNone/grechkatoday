<?php

namespace KNone\Grecha\Command;

use KNone\Grecha\Price\ImporterInterface;
use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;

class CacheClear extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:cache:clear')
            ->setDescription('Clear application cache');
    }

    /**
     * @param  string $dirPath
     * @return bool
     */
    protected function deleteDir($dirPath) {
        if (!is_dir($dirPath)) {
            return false;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }

        $files = glob($dirPath . '*', GLOB_MARK);

        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDir($file);
            } else {
                unlink($file);
            }
        }

        return rmdir($dirPath);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {     
        $rootDir = $this->getSilexApplication()['root_dir'].'/';
        $cacheDirs = $this->getSilexApplication()['config']['cache']['dir'];

        foreach ($cacheDirs as $cacheName => $cacheDir) {
            $cacheDir = $rootDir.$cacheDir;
            $output->writeln(sprintf('Clear %s cache (%s)', $cacheName, $cacheDir));
        }

        $output->writeln('Chache clear finished');


        return 0;
    }
}
