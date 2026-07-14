<?php
// tiger:snippet label="Initials" category="String" scope="global"
//   description="initials($name): 'John Doe' → 'JD' (first + last). Handy for avatars."

if (!function_exists('initials')) {
    /** "John Ronald Doe" → "JD" (first + last word initial). */
    function initials(string $name): string
    {
        $words = preg_split('/\s+/', trim($name), -1, PREG_SPLIT_NO_EMPTY) ?: [];
        if (!$words) { return ''; }
        if (count($words) === 1) { return strtoupper(mb_substr($words[0], 0, 1)); }
        return strtoupper(mb_substr($words[0], 0, 1) . mb_substr((string) end($words), 0, 1));
    }
}
