<?php defined('SYSPATH') or die('No direct access allowed.');

Route::set('users', 'users(/<action>(/<id>))')
->defaults(array(
        'controller'=> 'users',
        'action'    => 'index',
));
