<?php 

class Model_Gallery_Item extends ORM{

	protected $_table_name = 'galleries_items';
	protected $_belongs_to = array(
			'gallery'	=> array(
		    	'model' => 'gallery',
				'foreign_key' => 'gallery_id',
	)
	);
	

}