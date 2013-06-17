<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    'default' => array
    (
        'type'       => 'postgresql',
        'connection' => array(
            'hostname'   => 'localhost',
            'username'   => 'postgres',
            'password'   => 'gbuvtyn',
            'persistent' => FALSE,
            'database'   => 'tafisha',

        ),
        'primary_key'  => '',
        'schema'       => 'public',
        'table_prefix' => '',
        'charset'      => 'utf8',
        'caching'      => FALSE,
        'profiling'    => TRUE,
    ),

);