<?php

namespace KNone\Grecha\Infrastructure\Silex\Command;

use KNone\Grecha\Application\Preview\PreviewCreator;
use Knp\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreatePreview extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:preview:create')
            ->setDescription('');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $previewCreator = new PreviewCreator();
        $previewCreator->createPreview($this->getSilexApplication()['root_dir'] . '/web/images/share/snapshot.png');

        return 0;
    }
}
