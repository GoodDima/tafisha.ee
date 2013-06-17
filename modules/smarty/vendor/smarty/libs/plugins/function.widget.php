<?php


function smarty_function_widget($params, Smarty_Internal_Template &$template)
{
	
	$attributes = array();
	foreach ($params as $_key => $_value)
	{
		switch ($_key)
		{
			case 'controller':
			case 'action':
				$$_key = $_value;
				break;
	
			default:
				$attributes[$_key] = $_value;
			break;
		}
	}

	$request = Request::factory(sprintf('%s/%s', $controller, $action));
	$request->query($attributes);
	return $request->execute();

}