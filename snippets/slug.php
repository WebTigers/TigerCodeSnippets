<?php
// tiger:snippet label="Slugify" category="String" scope="global"
//   description="slug($s): turn any string into a lowercase, URL-safe slug."

if (!function_exists('slug')) {
    /** "Hello, World!" → "hello-world". */
    function slug(string $s, string $sep = '-'): string
    {
        if (function_exists('iconv')) {
            $t = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $s);
            if ($t !== false) { $s = $t; }
        }
        $s = preg_replace('/[^a-z0-9]+/', $sep, strtolower(trim($s)));
        return trim((string) $s, $sep);
    }
}
