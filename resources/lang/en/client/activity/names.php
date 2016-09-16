<?php

return [
    'activity' => '{' . config('common.activity.activity_follow') . '} :user_name following :target_name|
                    {' . config('common.activity.activity_unfollow') . '} :user_name unfollow :target_name|
                    {' . config('common.activity.activity_learned'). '} :user_name learned :target_name|
                    {' . config('common.activity.activity_learning'). '} :user_name learning :target_name',
];
