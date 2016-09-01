<?php

return [
    'system_path' => '/images/systems/',
    'system_images' => [
        'logo' => 'logo.png',
    ],
    'menu' => [
        'default_menu' => 'home',
    ],
    'sort' => [
        'sort_increasing' => 'asc',
        'sort_descending' => 'desc',
    ],
    'user' => [
        'path' => [
            'avatar_url' => '/images/avatars/',
            'default_name_avatar' => 'default-avatar.png',
        ],
        'pagination' => [
            'default_number_record' => 10,
        ],
        'file' => [
            'avatar_max_size' => 2000,
        ],
        'length' => [
            'user_name_length' => 50,
            'user_email_length' => 255,
            'user_password_length' => 60,
        ],
    ],
    'category' => [
        'path' => [
            'image_url' => '/images/categories/',
            'default_name_image' => 'default-category.png',
        ],
        'pagination' => [
            'default_number_record_category' => 5,
        ],
        'file' => [
            'image_max_size' => 10000,
        ],
        'length' => [
            'category_name_length' => 20,
            'category_introduction_length' => 100,
        ],
    ],
];
