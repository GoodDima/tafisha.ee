<?php defined('SYSPATH') or die('No direct access allowed.');

Route::set('events', 'events(/<action>(/<id>))')
->defaults(array(
        'controller'=> 'events',
        'action'    => 'index',
));
