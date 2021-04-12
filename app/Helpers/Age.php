<?php
if (! function_exists('age')) {
    function age(int $id) {
        switch ($id) {
            case '1':
                return "13-18";
            case '2':
                return "19-25";
            case '3':
                return "26-36";
            case '4':
                return "36-45";
            case '5':
                return "46-60";
        }
    }
}
