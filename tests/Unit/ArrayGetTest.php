<?php
// SPDX-License-Identifier: BSD-3-Clause
// Copyright (c) 2026 WebTigers. Tiger™ and WebTigers™ are trademarks of WebTigers.

namespace TigerCodeSnippets\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * array_get($arr, 'a.b.c', $default): read a nested value by dot-path, returning $default the moment
 * a segment is missing or an intermediate value is not an array (never a warning, never a fatal).
 */
final class ArrayGetTest extends TestCase
{
    private array $cfg = [
        'mail'   => ['smtp' => ['host' => 'mx.example', 'port' => 587]],
        'name'   => 'Tiger',
        'flag'   => false,
        'nothing'=> null,
    ];

    public function testReadsANestedValue(): void
    {
        $this->assertSame('mx.example', array_get($this->cfg, 'mail.smtp.host'));
        $this->assertSame(587, array_get($this->cfg, 'mail.smtp.port'));
    }

    public function testReadsATopLevelValue(): void
    {
        $this->assertSame('Tiger', array_get($this->cfg, 'name'));
    }

    public function testMissingKeyReturnsTheDefault(): void
    {
        $this->assertNull(array_get($this->cfg, 'mail.smtp.user'));
        $this->assertSame('localhost', array_get($this->cfg, 'mail.smtp.user', 'localhost'));
        $this->assertSame('def', array_get($this->cfg, 'does.not.exist', 'def'));
    }

    public function testStopsCleanlyWhenAnIntermediateIsNotAnArray(): void
    {
        // 'name' is a string, so 'name.sub' can't descend — returns the default, not a warning.
        $this->assertSame('d', array_get($this->cfg, 'name.sub', 'd'));
    }

    public function testReturnsAFalseyStoredValueNotTheDefault(): void
    {
        // A present `false` / `null` must be returned as-is — array_key_exists, not isset.
        $this->assertFalse(array_get($this->cfg, 'flag', 'fallback'));
        $this->assertNull(array_get($this->cfg, 'nothing', 'fallback'));
    }
}
