<?php

return [
    'master' => [
        'heading_panel_user_list' => 'List all user',
    ],
    'home' => [
        'title_home_client' => 'User - Home',
        'label_count_word_learned' => 'Learned :numberOfWords word|Learned :numberOfWords words',
        'label_user_follow' => 'User follow',
        'label_follow_user' => 'Follow user',
        'label_Activities' => 'Activities',
    ],
    'category' => [
        'title_category_client' => 'User - Category',
        'heading_panel_category' => 'List all categories of system',
    ],
    'lesson' => [
        'title_lesson_client' => 'User - Lesson',
        'label_key_answer' => 'answer',
    ],
    'word_list' => [
        'title_word_list_client' => 'User - Word - List',
        'heading_panel_word_list' => 'Word list',
        'none_combobox' => 'None',
        'label_filter_type' => 'Filter type',
        'label_filter_key' => 'filter',
        'label_word_learned_filter_key' =>'word_learned',
        'label_word_not_learned_filter_key' =>'word_not_learned',
        'label_word_all_filter_key' =>'word_all',
        'label_word_learned_filter' =>'Learned',
        'label_word_not_learned_filter' =>'Not learned',
        'label_word_all_filter' =>'All',
        'heading_panel_word_list_filter' => 'All words',
        'heading_panel_word_filter_result' => 'Filter result',
        'header_pdf_file' => '<h1 style="text-align: center">List words</h1>',
        'content_pdf_file' => '<li>:words</li>',
    ],
    'result' => [
        'title_result_client' => 'User - Result',
        'heading_panel_result' => 'Result summary',
        'body_panel_result' => 'You learned words: ',
    ],
    'profile' => [
        'title_profile_client' => 'User - Profile',
        'heading_panel_profile' => 'Profile',
    ],
    'activity' => '{' . config('common.activity.activity_follow') . '} :user_name following :target_name|
                    {' . config('common.activity.activity_un_follow') . '} :user_name un-follow :target_name|
                    {' . config('common.activity.activity_learned'). '} :user_name learned :target_name|
                    {' . config('common.activity.activity_learning'). '} :user_name learning :target_name',
];
