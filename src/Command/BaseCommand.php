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
     * Returns if array is associative.
     *
     * @param array<mixed> $array
     * @return bool
     */
    protected function isArrayAssociative(array $array): bool
    {
        if (array() === $array) {
            return false;
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * Returns the text of an array.
     *
     * @param array<mixed> $array
     * @return string
     */
    protected function getArrayText(array $array): string
    {
        if ($this->isArrayAssociative($array)) {
            $texts = [];

            foreach ($array as $key => $value) {
                $texts[] = sprintf('%s = %s', $key, strval($value));
            }
        } else {
            $texts = $array;
        }

        return implode(', ', $texts);
    }

    /**
     * Prints the output.
     *
     * @param string $title
     * @param string $from
     * @param string|array<mixed> $value
     * @return void
     * @throws Exception
     */
    protected function printOutput(string $title, string $from, string|array $value): void
    {
        $text = match (true) {
            is_array($value) => sprintf('%s → %s', $from, $this->getArrayText($value)),
            is_string($value) => sprintf('%s → %s', $from, $value),
        };

        $this->output->writeln([
            '',
            $title,
            str_repeat('=', strlen($title)),
            '',
            $text,
            ''
        ]);
    }
}