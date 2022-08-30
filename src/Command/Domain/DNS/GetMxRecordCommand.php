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
use App\Utils\Domain\DNS\ARecord;
use App\Utils\Domain\DNS\MxRecord;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
* Class GetMxRecordCommand
*
* @author Björn Hempel <bjoern@hempel.li>
* @version 1.0 (2022-08-30)
* @package App\Command\Domain\DNS
* @example bin/console domain:dns:get-mx-record [domain]
*/
#[AsCommand(
    name: 'domain:dns:get-mx-record',
    description: 'Gets the MX DNS record from given domain.'
)]
class GetMxRecordCommand extends BaseGetRecordCommand
{
    protected MxRecord $mxRecord;

    /**
     * GetMxRecordCommand constructor.
     *
     * @param MxRecord $mxRecord
     */
    public function __construct(MxRecord $mxRecord)
    {
        $this->mxRecord = $mxRecord;

        parent::__construct();
    }

    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setHelp('This command gives you the MX record from given domain.');
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

        $title = 'Domain:DNS:MX-Record';
        $this->printOutput($title, $domain, $all ? $this->mxRecord->getAll($domain) : $this->mxRecord->getString($domain));

        return Command::SUCCESS;
    }
}