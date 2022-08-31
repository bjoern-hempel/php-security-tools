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

/**
 * Class BaseRecord
 *
 * @author Björn Hempel <bjoern@hempel.li>
 * @version 1.0 (2022-08-30)
 * @package App\Utils\Domain\DNS
 */
abstract class BaseRecord
{
    /** @var string */
    public const NAME_FAKE_HOSTNAME = 'fake.ixno.de';

    /** @var string */
    public const NAME_FAKE_IP = '1.2.3.4';

    /** @var array<string, string|int> */
    public const VALUES_FAKE_HOSTNAME_A = ['host' => self::NAME_FAKE_HOSTNAME, 'class' => 'IN', 'ttl' => 0, 'type' => 'A', 'ip' => self::NAME_FAKE_IP, ];

    /** @var array<string, string|int> */
    protected const VALUES_FAKE_HOSTNAME_MX = ['host' => self::NAME_FAKE_HOSTNAME, 'class' => 'IN', 'ttl' => 0, 'type' => 'MX', 'pri' => 10, 'target' => 'mail.fake.ixno.de', ];

    /** @var array<string, string|int> */
    protected const VALUES_FAKE_HOSTNAME_NS1 = ['host' => self::NAME_FAKE_HOSTNAME, 'class' => 'IN', 'ttl' => 0, 'type' => 'NS', 'target' => 'ns1.fake.ixno.de', ];

    /** @var array<string, string|int> */
    protected const VALUES_FAKE_HOSTNAME_NS2 = ['host' => self::NAME_FAKE_HOSTNAME, 'class' => 'IN', 'ttl' => 0, 'type' => 'NS', 'target' => 'ns2.fake.ixno.de', ];

    /** @var array<string, string|int> */
    protected const VALUES_FAKE_HOSTNAME_NS3 = ['host' => self::NAME_FAKE_HOSTNAME, 'class' => 'IN', 'ttl' => 0, 'type' => 'NS', 'target' => 'ns3.fake.ixno.de', ];

    /** @var array<string, string|int|array<int, string>> */
    protected const VALUES_FAKE_HOSTNAME_TXT = ['host' => self::NAME_FAKE_HOSTNAME, 'class' => 'IN', 'ttl' => 0, 'type' => 'TXT', 'txt' => 'v=spf1 a mx -all', 'entries' => ['v=spf1 a mx -all'], ];

    /** @var array<string, string|int> */
    protected const VALUES_FAKE_HOSTNAME_SOA = ['host' => self::NAME_FAKE_HOSTNAME, 'class' => 'IN', 'ttl' => 0, 'type' => 'SOA', 'mname' => 'ns1.fake.ixno.de', 'rname' => 'hostmaster.fake.ixno.de', 'serial' => '2022040800', 'refresh' => 86400, 'retry' => 7200, 'expire' => 3600000, 'minimum-ttl' => 3600, ];

    /** @var array<int, array<string, string|int|array<int, string>>> */
    protected const VALUES_FAKE_HOSTNAME_ANY = [
        self::VALUES_FAKE_HOSTNAME_A,
        self::VALUES_FAKE_HOSTNAME_MX,
        self::VALUES_FAKE_HOSTNAME_NS1,
        self::VALUES_FAKE_HOSTNAME_NS2,
        self::VALUES_FAKE_HOSTNAME_NS3,
        self::VALUES_FAKE_HOSTNAME_TXT,
        self::VALUES_FAKE_HOSTNAME_SOA,
    ];

    /** @var array<int, array<int, array<string, string|int|array<int, string>>>> */
    protected const VALUES_FAKE_HOSTNAME = [
        DNS_A => [self::VALUES_FAKE_HOSTNAME_A, ],
        DNS_CAA => [],
        DNS_CNAME => [],
        DNS_HINFO => [],
        DNS_MX => [self::VALUES_FAKE_HOSTNAME_MX, ],
        DNS_NS => [self::VALUES_FAKE_HOSTNAME_NS1, self::VALUES_FAKE_HOSTNAME_NS2, self::VALUES_FAKE_HOSTNAME_NS3, ],
        DNS_PTR => [],
        DNS_SOA => [self::VALUES_FAKE_HOSTNAME_SOA, ],
        DNS_TXT => [self::VALUES_FAKE_HOSTNAME_TXT, ],
        DNS_AAAA => [],
        DNS_SRV => [],
        DNS_NAPTR => [],
        DNS_A6 => [],
        DNS_ALL => self::VALUES_FAKE_HOSTNAME_ANY,
        DNS_ANY => self::VALUES_FAKE_HOSTNAME_ANY,
    ];

    /**
     * Returns the DNS records.
     *
     * @param string $hostname
     * @param int $type
     * @param array<string>|null $authoritative_name_servers
     * @param array<string>|null $additional_records
     * @param bool $raw
     * @return array<int, array<string, string|int|array<int, string>>>|false
     */
    protected function getDnsGetRecord(string $hostname, int $type = DNS_ANY, array &$authoritative_name_servers = null, array &$additional_records = null, bool $raw = false): array|false
    {
        /* Returns fake values for testing purposes. */
        if ($hostname === self::NAME_FAKE_HOSTNAME && array_key_exists($type, self::VALUES_FAKE_HOSTNAME)) {
            return self::VALUES_FAKE_HOSTNAME[$type];
        }

        /* Returns real values. */
        return dns_get_record($hostname, $type, $authoritative_name_servers, $additional_records, $raw);
    }
}