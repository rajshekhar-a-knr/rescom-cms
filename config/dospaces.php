<?php

return [

    'do_spaces' => [
        'name'      => env('DO_SPACES_NAME', 'knrint-website'),
        'region'    => env('DO_SPACES_REGION', 'blr1'),
        'endpoint'  => env('DO_SPACES_ENDPOINT', 'https://blr1.digitaloceanspaces.com'),
        'key'       => env('DO_SPACES_KEY'),
        'secret'    => env('DO_SPACES_SECRET'),
        'permission'=> true,
        'path'      => env('DO_SPACES_PATH', 'https://knrint-website.blr1.digitaloceanspaces.com'),
    ],

    'paths' => [
        'company_logo'      => 'SiteLogo',
    ],

];