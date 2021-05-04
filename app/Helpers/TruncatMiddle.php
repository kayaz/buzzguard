<?php

if (! function_exists('truncateMiddle')) {
    function truncateMiddle($string, $maxLength)
    {
        if (strlen($string) <= $maxLength) return $string;

        $numRightChars = ceil($maxLength / 2);
        $numLeftChars = floor($maxLength / 2) - 3; // to accommodate the "..."

        return sprintf("%s...%s", substr($string, 0, $numLeftChars), substr($string, 0 - $numRightChars));
    }
}
