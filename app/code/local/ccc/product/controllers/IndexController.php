<?php
/**
 * 
 */
class Ccc_Product_IndexController extends Mage_Core_Controller_Front_Action
{
	
	function indexAction()
	{
		 $this->loadLayout();  
        $this->renderLayout();
		
	}

	public function ProductAction()
	{
		echo 222;
	}

}