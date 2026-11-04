<?php
// SPDX-License-Identifier: BSD-3-Clause
// Copyright (c) 2026 WebTigers. Tiger™ and WebTigers™ are trademarks of WebTigers.

namespace TigerCodeSnippets\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * slug($s, $sep): a lowercase, URL-safe slug — runs of non-alphanumerics collapse to the separator,
 * which is then trimmed from both ends. (Accent transliteration is a best-effort iconv//TRANSLIT
 * pass whose exact output is platform-dependent — libiconv vs glibc differ — so it is deliberately
 * NOT asserted here; that would be testing iconv, not this function.)
 */
final class SlugTest extends TestCase
{
    public static function cases(): array
    {
        return [
            'punctuation'      => ['Hello, World!', '-', 'hello-world'],
            'spaces-trimmed'   => ['  Spaced  Out  ', '-', 'spaced-out'],
            'leading-trailing' => ['!!!Hi!!!', '-', 'hi'],
            'already-a-slug'   => ['already-slug', '-', 'already-slug'],
            'numbers-and-dots' => ['Tiger 2.0 Release', '-', 'tiger-2-0-release'],
            'underscore-sep'   => ['Hello World', '_', 'hello_world'],
            'empty'            => ['', '-', ''],
            'only-punct'       => ['@#$%', '-', ''],
        ];
    }

    #[DataProvider('cases')]
    public function testSlug(string $in, string $sep, string $expected): void
    {
        $this->assertSame($expected, slug($in, $sep));
    }
}
