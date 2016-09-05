<?php

return [
    'admin' => [
        'name' => [
            'required' => 'Please enter name of category',
            'max' => 'Name of category is maximum 20 characters',
        ],
        'introduction' => [
            'required' => 'Please enter introduction of category',
            'max' => 'Introduction of category is maximum 100 characters',
        ],
        'image' => [
            'file' => 'This image not uploaded on server. Please upload again!',
            'image' => 'File is not image(.jpeg, .png, .bmp, .gif, or .svg). Please upload again!',
            'max' => 'Size of image is maximum 10MB',
        ],
    ],
];
