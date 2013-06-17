<?php 

class Model_Gallery extends ORM{

	protected $_table_name = 'galleries';
	protected $_has_many = array(
		'items'    => array(
	        'model'			=> 'gallery_item',
	    	'foreign_key'	=> 'gallery_id',
		)
	);	
}