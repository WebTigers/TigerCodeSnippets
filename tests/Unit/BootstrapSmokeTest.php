<?php
// SPDX-License-Identifier: BSD-3-Clause
// Copyright (c) 2026 WebTigers. Tiger™ and WebTigers™ are trademarks of WebTigers.

namespace TigerCodeSnippets\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * The harness is wired: tiger-core's autoloader resolved (Tiger_* available for any future needs)
 * and every snippet in snippets/ was require'd by the bootstrap, so its global function is defined.
 */
final class BootstrapSmokeTest extends TestCase
{
    public function testTigerCoreAutoloaderResolved(): void
    {
        $this->assertTrue(class_exists('Tiger_Application'), 'tiger-core autoloader should be on the include path');
    }

    /**
     * Every shipped snippet file must have defined its advertised global function — this is the
     * module's entire contract (the snippets/ folder is the capability marker).
     */
    public function testEverySnippetDefinedItsFunction(): void
    {
        foreach (['slug', 'human_bytes', 'time_ago', 'array_get', 'initials', 'ordinal'] as $fn) {
            $this->assertTrue(function_exists($fn), "snippet function $fn() should be defined");
        }
    }
}
