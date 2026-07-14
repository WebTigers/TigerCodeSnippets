<?php
// tiger:snippet label="Ordinal" category="Number" scope="global"
//   description="ordinal($n): 1 → '1st', 2 → '2nd', 23 → '23rd'."

if (!function_exists('ordinal')) {
    /** Ordinal suffix: 1 → "1st", 11 → "11th", 22 → "22nd". */
    function ordinal(int $n): string
    {
        $mod100 = abs($n) % 100;
        if ($mod100 >= 11 && $mod100 <= 13) { return $n . 'th'; }
        $v = abs($n) % 10;
        return $n . (['th', 'st', 'nd', 'rd'][$v] ?? 'th');
    }
}
