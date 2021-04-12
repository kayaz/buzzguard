<?php

if (! function_exists('dayName')) {
    function dayName($format, $timestamp)
    {
        $arrLocales = array('pl_PL', 'pl', 'Polish_Poland.28592');
        setlocale( LC_ALL, $arrLocales );

        return iconv("ISO-8859-2", "UTF-8",ucfirst(strftime($format, $timestamp)));
    }
}
