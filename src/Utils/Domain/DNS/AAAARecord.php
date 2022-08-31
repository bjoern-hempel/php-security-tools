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
 * Class AAAARecord
 *
 * @author Björn Hempel <bjoern@hempel.li>
 * @version 1.0 (2022-08-31)
 * @package App\Utils\Domain\DNS
 */
class AAAARecord extends BaseRecord
{
    protected int $type = DNS_AAAA;

    protected const INDEX_NAME_IPV6 = 'ipv6';

    /**
     * Returns all entries of AAAA DNS record.
     *
     * @param string $domain
     * @return array<string, string|int|array<int, string>>
     * @throws NotFoundException
     */
    public function getAll(string $domain): array
    {
        $array = $this->getDnsGetRecord($domain, $this->type);

        if ($array === false) {
            throw new NotFoundException('AAAA record', $domain);
        }

        return $array[0];
    }

    /**
     * Returns the AAAA Record
     *
     * @param string $domain
     * @return string
     * @throws NotFoundException
     */
    public function getString(string $domain): string
    {
        $aRecord = $this->getAll($domain);

        if (!array_key_exists(self::INDEX_NAME_IPV6, $aRecord)) {
            throw new NotFoundException('Array index', self::INDEX_NAME_IPV6);
        }

        return strval($aRecord[self::INDEX_NAME_IPV6]);
    }
}