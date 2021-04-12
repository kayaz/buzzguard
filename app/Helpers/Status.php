<?php

if (! function_exists('status')) {
    function status(int $number)
    {
        if ($number == 1) {
            $result = '<i class="fe-eye"></i>';
        } else {
            $result = '<i class="fe-eye-off text-muted"></i>';
        }
        return $result;
    }
}
