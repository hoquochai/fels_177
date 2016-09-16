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
    'word' => [
        'pagination' => [
            'default_number_record_word' => 20,
        ],
        'length' => [
            'word_content_length' => 255,
        ],
    ],
    'word_answer' => [
        'pagination' => [
            'default_number_record_word_answer' => 20,
        ],
        'length' => [
            'word_answer_content_length' => 255,
        ],
        'correct' => [
            'result_true' => 1,
            'result_false' => 0,
        ],
    ],
    'word_filter' => [
        'word_learned_filter' => 1,
        'word_not_learned_filter' => 2,
        'word_all_filter' => 3,
    ],
    'home' => [
        'default_number_record_follow' => 5,
    ],
    'activity' => [
        'activity_follow' => 1,
        'activity_unfollow' => 2,
        'activity_learned' => 3,
        'activity_learning' => 4,
    ],
    'result' => [
        'default_number_record_result' => 2,
    ]
];
