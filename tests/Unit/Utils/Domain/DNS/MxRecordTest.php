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
use App\Utils\Domain\DNS\BaseRecord;
use App\Utils\Domain\DNS\MxRecord;
use PHPUnit\Framework\TestCase;

/**
 * Class MxRecordTest
 *
 * @author Björn Hempel <bjoern@hempel.li>
 * @version 1.0 (2022-08-31)
 * @package App\Tests\Unit\Utils\Domain\DNS
 */
final class MxRecordTest extends TestCase
{
    /**
     * Test wrapper.
     *
     * @dataProvider dataProvider
     *
     * @test
     * @testdox $number) Test ARecord: $domain
     * @param int $number
     * @param string $domain
     * @param bool $all
     * @param string|array<string, string|int> $expected
     * @throws NotFoundException
     */
    public function wrapper(int $number, string $domain, bool $all, string|array $expected): void
    {
        /* Arrange */
        $mxRecord = new MxRecord();

        /* Act */
        $current = $all ? $mxRecord->getAll($domain) : $mxRecord->getString($domain);

        /* Assert */
        $this->assertEquals($expected, $current);
    }

    /**
     * Data provider.
     *
     * @return array<int, array{int, string, bool, string|array<string, string|int>}>
     */
    public function dataProvider(): array
    {
        $number = 0;

        return [
            [++$number, BaseRecord::NAME_FAKE_HOSTNAME, false, BaseRecord::NAME_FAKE_MX_TARGET, ],
            [++$number, BaseRecord::NAME_FAKE_HOSTNAME, true, BaseRecord::VALUES_FAKE_HOSTNAME_MX, ]
        ];
    }
}
