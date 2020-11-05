<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\TwitterService;

class TwitterGetContentCommand extends Command
{

    private TwitterService $twitterService;

    public function __construct(TwitterService $twitterService)
    {
        $this->twitterService = $twitterService;

        parent::__construct();
    }

    protected static $defaultName = 'twitter:get-content';

    protected function configure()
    {
        $this->setDescription('Get content from twitter');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->twitterService->run();

        return 0;
    }
}
