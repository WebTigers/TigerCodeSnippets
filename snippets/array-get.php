<?php
// tiger:snippet label="Array get (dot)" category="Array" scope="global"
//   description="array_get($arr, 'a.b.c', $default): read a nested array value by dot-path."

if (!function_exists('array_get')) {
    /** array_get($cfg, 'mail.smtp.host', 'localhost'). */
    function array_get(array $arr, string $path, $default = null)
    {
        foreach (explode('.', $path) as $key) {
            if (!is_array($arr) || !array_key_exists($key, $arr)) { return $default; }
            $arr = $arr[$key];
        }
        return $arr;
    }
}
