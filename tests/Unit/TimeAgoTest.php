<?php
// SPDX-License-Identifier: BSD-3-Clause
// Copyright (c) 2026 WebTigers. Tiger™ and WebTigers™ are trademarks of WebTigers.

namespace TigerCodeSnippets\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * time_ago($time): a relative "… ago" string from a timestamp or a date string. Driven off time()
 * with offsets chosen comfortably inside each band, so a one-second tick during the test can't cross
 * a floor() boundary and flake. (The seconds band is asserted by shape for the same reason.)
 */
final class TimeAgoTest extends TestCase
{
    public function testJustNowWithinFiveSeconds(): void
    {
        $this->assertSame('just now', time_ago(time()));
        $this->assertSame('just now', time_ago(time() - 2));
    }

    public function testSecondsBand(): void
    {
        // Count can drift by one at the boundary, so assert the band's shape, not an exact number.
        $this->assertMatchesRegularExpression('/^\d+ seconds ago$/', time_ago(time() - 30));
    }

    public function testSingularAndPluralBands(): void
    {
        $this->assertSame('1 hour ago',   time_ago(time() - 3630));       // 1h + 30s
        $this->assertSame('2 hours ago',  time_ago(time() - 7230));
        $this->assertSame('1 day ago',    time_ago(time() - 86400 - 100));
        $this->assertSame('2 days ago',   time_ago(time() - 172800 - 100));
        $this->assertSame('1 week ago',   time_ago(time() - 604800 - 100));
        $this->assertSame('1 month ago',  time_ago(time() - 2592000 - 100));
        $this->assertSame('1 year ago',   time_ago(time() - 31536000 - 100));
    }

    public function testAcceptsADateString(): void
    {
        $this->assertSame('1 hour ago', time_ago(date('Y-m-d H:i:s', time() - 3630)));
    }
}
