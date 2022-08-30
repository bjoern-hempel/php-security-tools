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

namespace App\Utils\Domain\DNS;

use App\Exception\NotFoundException;

/**
 * Class MxRecord
 *
 * @author Björn Hempel <bjoern@hempel.li>
 * @version 1.0 (2022-08-30)
 * @package App\Utils\Domain\DNS
 */
class MxRecord extends BaseRecord
{
    protected int $type = DNS_MX;

    protected const INDEX_NAME_TARGET = 'target';

    /**
     * Returns all entries of MX DNS record.
     *
     * @param string $domain
     * @return array<mixed>
     * @throws NotFoundException
     */
    public function getAll(string $domain): array
    {
        $array = $this->getDnsGetRecord($domain, $this->type);

        if ($array === false) {
            throw new NotFoundException('MX record', $domain);
        }

        return $array[0];
    }

    /**
     * Returns the A Record
     *
     * @param string $domain
     * @return string
     * @throws NotFoundException
     */
    public function getString(string $domain): string
    {
        $aRecord = $this->getAll($domain);

        if (!array_key_exists(self::INDEX_NAME_TARGET, $aRecord)) {
            throw new NotFoundException('Array index', self::INDEX_NAME_TARGET);
        }

        return $aRecord[self::INDEX_NAME_TARGET];
    }
}