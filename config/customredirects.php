<?php

return [
    'user_types' => [
        'admin_user' => 1,
        'beneficiary' => 2,
        'official_user' => 3,
        'agency_user'=>6,
        'nodal_officer'=>7
    ],
    'redirects' => [
        'admin_user' => 'home.admin',
        'beneficiary' => 'home.beneficiary',
        'official_user' => 'home.official',
        'default' => 'home.index',
    ],
];