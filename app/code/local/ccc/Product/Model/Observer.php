<?php

/**
 * 
 */
class Ccc_Product_Model_Observer extends Varien_Event_Observer
{
	
	function __construct()
	{
		// echo "this is an observer class";
	}

	public function test($obs)
	{
		// echo '<pre>';
		// print_r(get_class_methods($obs));
		// print_r($obs->getEvent());
		// echo "this is test method in observer class";
		// die();
	}
}