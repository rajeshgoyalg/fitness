<?php

// db configuration
$config['db'] = [
    'driver'   => 'mysql',
    'host'     => 'localhost',
    'port'     => '3306',
    'username' => 'root',
    'password' => '',
    'dbname'   => 'fitness',
];

// smtp configuration
$config['smtp'] = [
    'host'     => 'ssl://smtp.fitnessapp.com',
    'username' => 'youremail@fitnessapp.com',
    'password' => 'your email password',
    'port'     => '465'
];