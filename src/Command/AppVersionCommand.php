<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppVersionCommand extends Command
{
    protected static $defaultName = 'app:version';

    protected function configure()
    {
        $this
            ->setDescription('Display Symfony and Vulcano version.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        /**
         * Fetch the app version.
         */
        $json = file_get_contents('./app.json');
        $app_data = json_decode($json, true);

        /**
         * Fetch the Symfony version.
         */
        $symfony_version = exec('php bin/console --version');

        $io->success([
            'Vulcano version: '.$app_data['version'],
            $symfony_version,
        ]);
    }
}
