<?php
// tiger:snippet label="Human bytes" category="Format" scope="global"
//   description="human_bytes($n): format a byte count as 1.5 KB, 3.2 MB, …"

if (!function_exists('human_bytes')) {
    /** 1536 → "1.5 KB". */
    function human_bytes(int $bytes, int $precision = 1): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $bytes = max($bytes, 0);
        $pow   = $bytes > 0 ? (int) floor(log($bytes, 1024)) : 0;
        $pow   = min($pow, count($units) - 1);
        return round($bytes / (1024 ** $pow), $precision) . ' ' . $units[$pow];
    }
}
