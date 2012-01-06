<?php

$config = array(
    'name' => 'identifiy_name',
    'auth' => array(
        'password_salt' => 'hash-hash-hash-hash-hash',
        'users' => array(
            array(
                'name' => 'user',
                'hash' => 'hash',
                'role' => Auth::ROLE_ADMIN,
            ),
        ),
    ),
    'db' => array(
        'host' => 'host.domain',
        'port' => '3306',
        'user' => 'user',
        'password' => 'pwd',
        'database' => 'dbname',
    ),
    'cache' => TRUE,
    'debug' => FALSE,
);