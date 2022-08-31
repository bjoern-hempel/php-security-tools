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

namespace App\Command;

use App\Utils\Converter\Array2String;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BaseCommand
 *
 * @author Björn Hempel <bjoern@hempel.li>
 * @version 1.0 (2022-08-30)
 * @package App\Command
 */
abstract class BaseCommand extends Command
{
    protected OutputInterface $output;

    /**
     * Sets the output.
     *
     * @param OutputInterface $output
     */
    protected function setOutput(OutputInterface $output): void
    {
        $this->output = $output;
    }

    /**
     * Prints the output.
     *
     * @param string $title
     * @param string $from
     * @param string|array<string, string|int|array<int, string>> $value
     * @return void
     * @throws Exception
     */
    protected function printOutput(string $title, string $from, string|array $value): void
    {
        $text = match (true) {
            is_array($value) => sprintf('%s → %s', $from, Array2String::getArrayText($value)),
            is_string($value) => sprintf('%s → %s', $from, $value),
        };

        $this->output->writeln([
            '',
            sprintf('[%s] (%s) %s', date('r'), $title, $text),
            ''
        ]);
    }
}