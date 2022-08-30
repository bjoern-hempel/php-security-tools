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

namespace App\Exception;

use Exception;

/**
 * Class ConfigurationNotFoundException
 *
 * @author Björn Hempel <bjoern@hempel.li>
 * @version 1.0 (2022-08-30)
 * @package App\Exception
 */
final class NotFoundException extends Exception
{
    public const TEXT_PLACEHOLDER = '"%s" from "%s" was not found.';

    public const DEFAULT_TARGET = 'not_given';

    /**
     * NotFoundException constructor.
     *
     * @param string $queryType
     * @param ?string $target
     */
    public function __construct(string $queryType, string $target = null)
    {
        $message = sprintf(self::TEXT_PLACEHOLDER, $queryType, $target ?? self::DEFAULT_TARGET);

        parent::__construct($message);
    }
}
