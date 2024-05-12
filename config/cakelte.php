<?php

use CakeLte\Style\Header;
use CakeLte\Style\Sidebar;

return [
    'CakeLte' => [
        'app-name' => '<b>UBIG</b>',
        'app-logo' => 'https://ubig.co.id/wp-content/uploads/2023/12/ms-icon-310x310_1_-removebg-preview-3-300x300.png',

        'small-text' => false,
        'dark-mode' => false,
        'layout-boxed' => false,

        'header' => [
            'fixed' => false,
            'border' => true,
            'style' => Header::STYLE_WHITE,
            'dropdown-legacy' => false,
        ],

        'sidebar' => [
            'fixed' => true,
            'collapsed' => false,
            'mini' => true,
            'mini-md' => false,
            'mini-xs' => false,
            'style' => Sidebar::STYLE_DARK_PRIMARY,

            'flat-style' => false,
            'legacy-style' => false,
            'compact' => false,
            'child-indent' => false,
            'child-hide-collapse' => false,
            'disabled-auto-expand' => false,
        ],

        'footer' => [
            'fixed' => false,
        ],
    ],
];