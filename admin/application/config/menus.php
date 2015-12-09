<?php

$config['menus'] = [

    // Statistik
    [
        'name'  => 'Statistik',
        'icon'  => 'icon-home',
        'link'  => site_url(),
        'roles' => ['all'],
    ],

    // Artikel
    [
        'name'  => 'Artikel',
        'icon'  => 'icon-note',
        'link'  => '#',
        'roles' => ['su', 'adm', 'edt'],
        'child' => [
            [
                'name'  => 'Terbit',
                'icon'  => 'icon-note',
                'link'  => site_url('article'),
            ],
            [
                'name'  => 'Draft',
                'icon'  => 'icon-note',
                'link'  => site_url('article?status=draft'),
            ],
            [
                'name'  => 'Kategori',
                'icon'  => 'icon-calculator',
                'link'  => site_url('kategori'),
            ],
        ],
    ],

    // Page
    [
        'name'  => 'Page',
        'icon'  => 'fa fa-book',
        'link'  => site_url('pages'),
        'roles' => ['su', 'adm'],
    ],

    // Komentar
    [
        'name'  => 'Komentar',
        'icon'  => 'fa fa-comment',
        'link'  => site_url('comment'),
        'roles' => ['su', 'adm', 'edt'],
    ],

    // Media
    [
        'name'  => 'Media',
        'icon'  => 'icon-picture',
        'link'  => site_url('media'),
        'roles' => ['su', 'adm'],
    ],

    // Elibrary
    [
        'name'  => 'Elibrary',
        'icon'  => 'fa fa-upload',
        'link'  => site_url('elibrary'),
        'roles' => ['su', 'adm', 'pus'],
        'child' => [
            [
                'name'  => 'Terbit',
                'icon'  => 'fa fa-upload',
                'link'  => site_url('elibrary'),
            ],
            [
                'name'  => 'Elibrary',
                'icon'  => 'fa fa-upload',
                'link'  => site_url('elibrary?status=draft'),
            ],
            [
                'name'  => 'Kategori',
                'icon'  => 'fa fa-upload',
                'link'  => site_url('elibrary/category'),
            ]
        ]
    ],

    // Konsultasi
    [
        'name'  => 'Konsultasi',
        'icon'  => 'fa fa-upload',
        'link'  => site_url('konsultasi'),
        'roles' => ['su', 'adm'],
    ],

    // Forum
    [
        'name'  => 'Forum',
        'icon'  => 'fa fa-upload',
        'link'  => '#',
        'roles' => ['su', 'adm'],
        'child' => [
            [
                'name'  => 'Kategori',
                'icon'  => 'fa fa-upload',
                'link'  => site_url('forum/category'),
            ]
        ],
    ],

    // Pengguna
    [
        'name'  => 'Pengguna',
        'icon'  => 'icon-users',
        'link'  => site_url('user'),
        'roles' => ['su', 'adm'],
    ],

    // Link Informasi Desa
    [
        'name'  => 'Link Informasi Desa',
        'icon'  => 'fa fa-link',
        'link'  => site_url('link'),
        'roles' => ['su', 'adm'],
    ],

    // Setting
    [
        'name'  => 'Setting',
        'icon'  => 'icon-settings',
        'link'  => site_url('settings'),
        'roles' => ['su', 'adm'],
    ],

    // FAQ
    [
        'name'  => 'FAQ',
        'icon'  => 'icon-settings',
        'link'  => site_url('faq'),
        'roles' => ['su', 'adm'],
    ],
];
