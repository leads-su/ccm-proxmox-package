<?php

return [

    'default'                       =>  env('CCM_PROXMOX_DEFAULT_CONNECTION', 'proxmox'),

    'connections'                   =>  [
        'proxmox'                   =>  [
            'scheme'                =>  env('CCM_PROXMOX_CONNECTION_SCHEME', 'https'),
            'host'                  =>  env('CCM_PROXMOX_CONNECTION_HOST', '127.0.0.1'),
            'port'                  =>  env('CCM_PROXMOX_CONNECTION_PORT', 8006),
        ]
    ],

    'restrictions'                  =>  [
        'nodes'                     =>  [],
        'machines'                  =>  range(200, 299)
    ],

    'access_token'                  =>  [
        'prefix'                    =>  'PVEAPIToken',
        'configuration'             =>  [
            'username'              =>  env('CCM_PROXMOX_USERNAME', 'ccm'),
            'authorization_method'  =>  env('CCM_PROXMOX_PORTAL', 'pve'),
            'token_name'            =>  env('CCM_PROXMOX_TOKEN_NAME', 'ccm'),
            'token_value'           =>  env('CCM_PROXMOX_TOKEN', '')
        ]
    ]

];
