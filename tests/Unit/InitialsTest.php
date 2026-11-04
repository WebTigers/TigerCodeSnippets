<?php
// SPDX-License-Identifier: BSD-3-Clause
// Copyright (c) 2026 WebTigers. Tiger™ and WebTigers™ are trademarks of WebTigers.

namespace TigerCodeSnippets\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * initials($name): first + last word initial, uppercased (for avatars). A single word yields one
 * initial; whitespace-only yields ''. Middle names are ignored (first + last only).
 */
final class InitialsTest extends TestCase
{
    public static function cases(): array
    {
        return [
            'first-last'     => ['John Doe', 'JD'],
            'middle-ignored' => ['John Ronald Doe', 'JD'],
            'single-word'    => ['Madonna', 'M'],
            'lowercased-in'  => ['john doe', 'JD'],
            'extra-spaces'   => ['John   Doe', 'JD'],
            'empty'          => ['', ''],
            'whitespace'     => ['   ', ''],
        ];
    }

    #[DataProvider('cases')]
    public function testInitials(string $name, string $expected): void
    {
        $this->assertSame($expected, initials($name));
    }
}
