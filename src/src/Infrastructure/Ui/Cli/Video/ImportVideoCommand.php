<?php

namespace App\Infrastructure\Ui\Cli\Video;

use App\Application\Service\Video\DTO\ImportVideoDTO;
use App\Domain\Messenger\Query\Video\ImportVideos;
use App\Infrastructure\Messenger\QueryBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportVideoCommand extends Command
{
    /**
     * @var QueryBus
     */
    private $queryBus;


    public function __construct(QueryBus $queryBus)
    {
        parent::__construct(null);
        $this->queryBus = $queryBus;
    }

    protected function configure()
    {
        $this
            ->setName('video:import')
            ->addArgument('source', InputArgument::REQUIRED)
            ->setDescription('Import video by source');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $importVideosDTOs = $this->queryBus->dispatch(
            ImportVideos::fromArray(['source' => $input->getArgument('source')])
        );
        /** @var ImportVideoDTO  $importVideoDTO */
        foreach ($importVideosDTOs as $importVideoDTO) {
            $output->writeln(sprintf(
                'Importing: "%s"; Url: %s; Tags: %s',
                $importVideoDTO->title(),
                $importVideoDTO->url(),
                implode(', ', $importVideoDTO->tags())
            ));
        }
    }
}
