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
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
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
    protected ARecord $aRecord;

    /**
     * GetARecordCommand constructor.
     *
     * @param ARecord $aRecord
     */
    public function __construct(ARecord $aRecord)
    {
        $this->aRecord = $aRecord;

        parent::__construct();
    }

    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setHelp('This command gives you the A record from given domain.');
        parent::configure();
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
        $this->setOutput($output);

        $domain = strval($input->getArgument(self::NAME_ARGUMENT_DOMAIN));
        $all = boolval($input->getOption(self::NAME_ARGUMENT_ALL));

        $title = 'Domain:DNS:A-Record';
        $this->printOutput($title, $domain, $all ? $this->aRecord->getAll($domain) : $this->aRecord->getString($domain));

        return Command::SUCCESS;
    }
}