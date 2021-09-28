<?php
if (! function_exists('sentiments')) {
    function sentiments(int $id) {
        switch ($id) {
            case '1':
                return 'Pozytywny';
            case '2':
                return 'Neutralny';
            case '3':
                return 'Negatywny';
            case '4':
                return 'Nieoceniony';
        }
    }
}
