<?php

if (! function_exists('dayName')) {
    function dayName($date)
    {
        $days = array(
            'Niedziela',
            'Poniedziałek',
            'Wtorek',
            'Środa',
            'Czwartek',
            'Piątek',
            'Sobota'
        );

        return $days[date('w', strtotime($date))];
    }
}
