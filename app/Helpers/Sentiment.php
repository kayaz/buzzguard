<?php
if (! function_exists('sentiment')) {
    function sentiment(int $id) {
        switch ($id) {
            case '1':
                return '<span class="badge status-1" data-filter="Pozytywny">Pozytywny</span>';
            case '2':
                return '<span class="badge status-2" data-filter="Neutralny">Neutralny</span>';
            case '3':
                return '<span class="badge status-3" data-filter="Negatywny">Negatywny</span>';
            case '4':
                return '<span class="badge status-4" data-filter="Nieoceniony">Nieoceniony</span>';
        }
    }
}
