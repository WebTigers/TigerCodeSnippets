<?php
// SPDX-License-Identifier: BSD-3-Clause
// Copyright (c) 2026 WebTigers. Tiger™ and WebTigers™ are trademarks of WebTigers.

namespace TigerCodeSnippets\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * human_bytes($n, $precision): a byte count as B/KB/MB/…/PB. Clamps negatives to 0, caps the unit
 * at PB (so an absurd number never indexes past the units table), and rounds to $precision.
 */
final class HumanBytesTest extends TestCase
{
    public static function cases(): array
    {
        return [
            'zero'              => [0, 1, '0 B'],
            'just-under-a-kb'   => [1023, 1, '1023 B'],
            'one-kb'            => [1024, 1, '1 KB'],
            'one-and-a-half-kb' => [1536, 1, '1.5 KB'],
            'one-mb'            => [1048576, 1, '1 MB'],
            'mb-rounded'        => [1234567, 1, '1.2 MB'],
            'precision-2'       => [1536, 2, '1.5 KB'],
            'negative-clamped'  => [-5, 1, '0 B'],
        ];
    }

    #[DataProvider('cases')]
    public function testHumanBytes(int $bytes, int $precision, string $expected): void
    {
        $this->assertSame($expected, human_bytes($bytes, $precision));
    }

    /** A value beyond the units table must saturate at PB rather than run off the end. */
    public function testCapsAtPetabytes(): void
    {
        $this->assertSame('1024 PB', human_bytes(1024 ** 6));
        $this->assertStringEndsWith(' PB', human_bytes(1024 ** 5));
    }
}
