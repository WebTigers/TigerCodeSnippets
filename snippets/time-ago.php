<?php
// tiger:snippet label="Time ago" category="Time" scope="global"
//   description="time_ago($time): a relative 'time ago' string, e.g. '3 hours ago'."

if (!function_exists('time_ago')) {
    /** A timestamp or date string → "just now", "3 hours ago", "2 days ago". */
    function time_ago($time): string
    {
        $ts   = is_numeric($time) ? (int) $time : (int) strtotime((string) $time);
        $diff = time() - $ts;
        if ($diff < 5)  { return 'just now'; }
        if ($diff < 60) { return $diff . ' seconds ago'; }
        $units = [31536000 => 'year', 2592000 => 'month', 604800 => 'week', 86400 => 'day', 3600 => 'hour', 60 => 'minute'];
        foreach ($units as $secs => $label) {
            if ($diff >= $secs) {
                $n = (int) floor($diff / $secs);
                return $n . ' ' . $label . ($n > 1 ? 's' : '') . ' ago';
            }
        }
        return 'just now';
    }
}
