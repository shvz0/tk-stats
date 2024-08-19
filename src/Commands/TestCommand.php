<?php

namespace App\Commands;

use App\TKStats\TKStats;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(
    name: 'app:test',
    description: 'Test command used in developing',
    hidden: false,
    aliases: ['app:test']
)]
class TestCommand extends Command
{

    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output): int
    {
        $tkStats = new TKStats;
        dd($tkStats->getWavuPlayerStats('4TMBdRnb3R8Q'));

        return Command::SUCCESS;
    }

}