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
use App\Utils\Domain\DNS\AAAARecord;
use App\Utils\Domain\DNS\BaseRecord;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
* Class GetAAAARecordCommand
*
* @author Björn Hempel <bjoern@hempel.li>
* @version 1.0 (2022-08-31)
* @package App\Command\Domain\DNS
* @example bin/console domain:dns:get-aaaa-record [domain]
*/
#[AsCommand(
    name: 'domain:dns:get-aaaa-record',
    description: 'Gets the AAAA DNS record from given domain.'
)]
class GetAAAARecordCommand extends BaseGetRecordCommand
{
    /**
     * Returns the help message.
     *
     * @return string
     */
    protected function getCommandName(): string
    {
        return BaseRecord::NAME_TYPE_AAAA;
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
        return $this->executeBase($input, $output, new AAAARecord());
    }
}