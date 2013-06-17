<?php

class Model_Event extends ORM{
	protected $_belongs_to = array(
		'type'    => array(
	    	'model' => 'events_type',
			'foreign_key' => 'type_id',
		)
	);
}