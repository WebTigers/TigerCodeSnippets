<?php
// SPDX-License-Identifier: BSD-3-Clause
// Copyright (c) 2026 WebTigers. Tiger™ and WebTigers™ are trademarks of WebTigers.
/**
 * PHPUnit bootstrap for TigerCodeSnippets.
 *
 * This is a `code`-type module: it ships standalone PHP helper snippets in snippets/, each defining
 * ONE global function guarded with function_exists(). There are no prefixed module classes, so the
 * only thing the harness needs from tiger-core is PHPUnit itself (plus Tiger_* for the smoke test).
 * We resolve a tiger-core checkout's autoloader, then require every snippet so the functions are
 * defined for the tests.
 *
 * Resolve tiger-core via: $TIGER_CORE_VENDOR → $TIGER_CORE_PATH/vendor → a sibling ../tiger-core.
 */

error_reporting(E_ALL);

if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'testing');
}

$moduleRoot = dirname(__DIR__);
if (!defined('APPLICATION_ROOT')) {
    define('APPLICATION_ROOT', $moduleRoot);
}

$candidates = array_filter([
    getenv('TIGER_CORE_VENDOR') ?: null,
    getenv('TIGER_CORE_PATH') ? rtrim(getenv('TIGER_CORE_PATH'), '/') . '/vendor/autoload.php' : null,
    $moduleRoot . '/../tiger-core/vendor/autoload.php',
]);
$coreVendor = '';
foreach ($candidates as $c) {
    if (is_file($c)) { $coreVendor = $c; break; }
}
if ($coreVendor === '') {
    fwrite(STDERR, "\nTigerCodeSnippets tests need tiger-core's autoloader (Tiger_*/Zend_*/PHPUnit).\n"
        . "Set TIGER_CORE_VENDOR to a tiger-core checkout's vendor/autoload.php, or place tiger-core as a\n"
        . "sibling of TigerCodeSnippets and run `composer install` in it.\n\n");
    exit(1);
}
require $coreVendor;

$coreRoot = dirname($coreVendor, 2);
if (!defined('TIGER_CORE_PATH')) {
    define('TIGER_CORE_PATH', $coreRoot);
}

set_include_path(implode(PATH_SEPARATOR, array_filter([
    $coreRoot . '/vendor/webtigers/tigerzf/library',
    $coreRoot . '/library',
    get_include_path(),
])));

// The module's capability IS its snippets/ folder: each file defines one global helper function
// (guarded with function_exists). Require them all so every test can call them directly.
foreach (glob($moduleRoot . '/snippets/*.php') ?: [] as $snippet) {
    require_once $snippet;
}

// PSR-4 for the test-support namespace.
spl_autoload_register(static function ($class) {
    $prefix = 'TigerCodeSnippets\\Tests\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) { return; }
    $rel  = str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
    $file = __DIR__ . '/' . $rel;
    if (is_file($file)) { require $file; }
});
