<?php

class Ccc_Product_AdminController extends Mage_Core_Controller_Front_Action
{
	
	function indexAction()
	{
		$this->_title($this->__('Customers'))->_title($this->__('Manage Customers'));
		$this->loadLayout();
		$block = $this->getLayout()->createBlock('product/product');
		$helper = Mage::helper('product/product');
		$helper = Mage::helper('product/data');

		// $this->getLayout();
		$this->renderLayout();
		print_r(get_class_methods('Ccc_Product_IndexController'));
		 
	}

}