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

namespace App\Tests\Unit\Utils\Converter;

use App\Utils\Converter\Array2String;
use PHPUnit\Framework\TestCase;

/**
 * Class Array2StringTest
 *
 * @author Björn Hempel <bjoern@hempel.li>
 * @version 1.0 (2022-08-31)
 * @package App\Tests\Unit\Utils\Converter
 */
final class Array2StringTest extends TestCase
{
    /**
     * Test wrapper.
     *
     * @dataProvider dataProvider
     *
     * @test
     * @testdox $number) Test SizeConverter: $method
     * @param int $number
     * @param array<int|string, string|int> $values
     * @param string $expected
     */
    public function wrapper(int $number, array $values, string $expected): void
    {
        /* Arrange */

        /* Act */
        $current = Array2String::getArrayText($values);

        /* Assert */
        $this->assertEquals($expected, $current);
    }

    /**
     * Data provider.
     *
     * @return array<int, array{int, array<int|string, string|int|array<int, string>>, string}>
     */
    public function dataProvider(): array
    {
        $number = 0;

        return [
            [++$number, [], '', ],
            [++$number, [1, 2, 3, ], '1, 2, 3', ],
            [++$number, ['1', '2', '3', ], '1, 2, 3', ],
            [++$number, ['1', 2, '3', ], '1, 2, 3', ],
            [++$number, ['val1' => '1', 'val2' => 2, 'val3' => '3', ], 'val1 = 1, val2 = 2, val3 = 3', ],
            [++$number, ['val1' => '1', 'val2' => 2, 'val3' => ['1', '2', ], ], 'val1 = 1, val2 = 2, val3 = [1,2]', ],
        ];
    }
}
