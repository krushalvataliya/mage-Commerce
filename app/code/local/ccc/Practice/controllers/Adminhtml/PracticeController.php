<?php
class Ccc_Practice_Adminhtml_PracticeController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
        $collection = Mage::getModel('product/product')->getCollection()->toArray();
        print_r($collection);
        die;
    }

}