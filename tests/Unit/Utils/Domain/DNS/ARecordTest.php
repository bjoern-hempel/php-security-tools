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

namespace App\Tests\Unit\Utils\Domain\DNS;

use App\Exception\NotFoundException;
use App\Utils\Domain\DNS\ARecord;
use App\Utils\Domain\DNS\BaseRecord;
use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Class ARecordTest
 *
 * @author Björn Hempel <bjoern@hempel.li>
 * @version 1.0 (2022-08-30)
 * @package App\Tests\Unit\Utils\Domain\DNS
 */
final class ARecordTest extends TestCase
{
    /**
     * Test wrapper.
     *
     * @dataProvider dataProvider
     *
     * @test
     * @testdox $number) Test SizeConverter: $method
     * @param int $number
     * @param string $domain
     * @param bool $all
     * @param string|array<mixed> $expected
     * @throws NotFoundException
     */
    public function wrapper(int $number, string $domain, bool $all, string|array $expected): void
    {
        /* Arrange */
        $aRecord = new ARecord();

        /* Act */
        $current = $all ? $aRecord->getAll($domain) : $aRecord->getString($domain);

        /* Assert */
        $this->assertEquals($expected, $current);
    }

    /**
     * Data provider.
     *
     * @return array<int, array<int, int|string|bool|array<string, string|int>>>
     */
    public function dataProvider(): array
    {
        $number = 0;

        return [
            [++$number, 'fake.ixno.de', false, '1.2.3.4', ],
            [++$number, 'fake.ixno.de', true, BaseRecord::VALUES_FAKE_HOSTNAME_A, ]
        ];
    }
}
