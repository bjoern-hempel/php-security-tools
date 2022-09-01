<?php

declare(strict_types=1);

/*
* This file is part of the bjoern-hempel/php-security-tools project.
*
* (c) Björn Hempel <https://www.hempel.li/>
*
* For the full copyright and license information, please view the LICENSE.md
* file that was distributed with this source code.
*/

namespace App\Command\Domain\DNS;

use App\Command\BaseCommand;
use App\Exception\NotFoundException;
use App\Utils\Domain\DNS\BaseRecord;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
* Class BaseGetRecordCommand
*
* @author Björn Hempel <bjoern@hempel.li>
* @version 1.0 (2022-08-30)
* @package App\Command\Domain\DNS
*/
abstract class BaseGetRecordCommand extends BaseCommand
{
    protected const NAME_ARGUMENT_DOMAIN = 'domain';

    protected const NAME_ARGUMENT_ALL = 'all';

    /**
     * Returns the help message.
     *
     * @return string
     */
    abstract protected function getCommandName(): string;

    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setHelp(sprintf('This command gives you the %s record from given domain.', $this->getCommandName()))
            ->addArgument(self::NAME_ARGUMENT_DOMAIN, InputArgument::REQUIRED, 'Domain')
            ->addOption(self::NAME_ARGUMENT_ALL, null, InputOption::VALUE_NONE, 'Returns all properties.')
        ;
    }

    /**
     * Execute the command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param BaseRecord $baseRecord
     * @return int
     * @throws Exception
     */
    protected function executeBase(InputInterface $input, OutputInterface $output, BaseRecord $baseRecord): int
    {
        $this->setOutput($output);

        $domain = strval($input->getArgument(self::NAME_ARGUMENT_DOMAIN));
        $all = boolval($input->getOption(self::NAME_ARGUMENT_ALL));

        $this->printOutput($baseRecord->getCommandPath(), $domain, $all ? $baseRecord->getAll($domain) : $baseRecord->getString($domain));

        return Command::SUCCESS;
    }
}