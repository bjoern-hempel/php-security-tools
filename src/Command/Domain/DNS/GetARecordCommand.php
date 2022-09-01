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

use App\Exception\NotFoundException;
use App\Utils\Domain\DNS\ARecord;
use App\Utils\Domain\DNS\BaseRecord;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
* Class GetARecordCommand
*
* @author Björn Hempel <bjoern@hempel.li>
* @version 1.0 (2022-08-30)
* @package App\Command\Domain\DNS
* @example bin/console domain:dns:get-a-record [domain]
*/
#[AsCommand(
    name: 'domain:dns:get-a-record',
    description: 'Gets the A DNS record from given domain.'
)]
class GetARecordCommand extends BaseGetRecordCommand
{
    /**
     * Returns the help message.
     *
     * @return string
     */
    protected function getCommandName(): string
    {
        return BaseRecord::NAME_TYPE_A;
    }

    /**
     * Execute the command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws NotFoundException
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return $this->executeBase($input, $output, new ARecord());
    }
}