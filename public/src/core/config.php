<?php

function config()
{
    return [
        'debug' => true,             // ⚠️ hosting-ում՝ false

        'db' => [
            'host' => 'MySQL-8.4:3306',
            'name' => 'technomarket',
            'user' => 'root',
            'password' => '',
            'charest' => 'utf8mb4',
        ],
    ];
}

?>