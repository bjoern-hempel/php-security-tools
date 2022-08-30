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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

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
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->addArgument(self::NAME_ARGUMENT_DOMAIN, InputArgument::REQUIRED, 'Domain')
            ->addOption(self::NAME_ARGUMENT_ALL, null, InputOption::VALUE_NONE, 'Returns all properties.')
        ;
    }
}