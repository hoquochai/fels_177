<?php

return [
    'admin' => [
        'name' => [
            'required' => 'Please enter name of user',
            'max' => 'Name of user is maximum 50 characters',
        ],
        'email' => [
            'required' => 'Please enter email of user',
            'email' => 'Email invalid. Please enter again!',
            'unique' => 'Email is exist in system. Please enter again!',
        ],
        'password' => [
            'required' => 'Please enter password of user',
            'max' => 'Password of user is maximum 50 characters',
        ],
        'avatar' => [
            'file' => 'This avatar not uploaded on server. Please upload again!',
            'image' => 'File is not image(.jpeg, .png, .bmp, .gif, or .svg).Please upload again!',
            'max' => 'Size of avatar is maximum 2MB',
            'move' => 'File did not upload: ',
            'delete' => 'File not deleted: ',
        ],
    ],
];
