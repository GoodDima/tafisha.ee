<?php defined('SYSPATH') or die('No direct access allowed.');

Route::set('pics', 'pics(/<action>(/<id>))')
->defaults(array(
        'controller'=> 'pics',
        'action'    => 'index',
));
