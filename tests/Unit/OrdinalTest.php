<?php
// SPDX-License-Identifier: BSD-3-Clause
// Copyright (c) 2026 WebTigers. Tiger™ and WebTigers™ are trademarks of WebTigers.

namespace TigerCodeSnippets\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * ordinal($n): the English ordinal suffix. The load-bearing subtlety is the teens exception —
 * 11/12/13 (and 111/112/113) take "th", NOT st/nd/rd — which the mod-100 ∈ [11,13] guard handles.
 */
final class OrdinalTest extends TestCase
{
    public static function cases(): array
    {
        return [
            'one'           => [1, '1st'],
            'two'           => [2, '2nd'],
            'three'         => [3, '3rd'],
            'four'          => [4, '4th'],
            'eleven-teen'   => [11, '11th'],
            'twelve-teen'   => [12, '12th'],
            'thirteen-teen' => [13, '13th'],
            'twenty-one'    => [21, '21st'],
            'twenty-two'    => [22, '22nd'],
            'twenty-three'  => [23, '23rd'],
            'hundred'       => [100, '100th'],
            'hundred-one'   => [101, '101st'],
            'c-eleven'      => [111, '111th'],
            'c-twelve'      => [112, '112th'],
            'c-thirteen'    => [113, '113th'],
            'zero'          => [0, '0th'],
        ];
    }

    #[DataProvider('cases')]
    public function testOrdinal(int $n, string $expected): void
    {
        $this->assertSame($expected, ordinal($n));
    }
}
