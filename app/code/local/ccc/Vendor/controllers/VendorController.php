<?php

class Ccc_Vendor_VendorController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        // print_r(get_class_methods('Ccc_Vendor_VendorController'));
        // $helper = Mage::helper('vendor/Data');
        // $model = Mage::getModel('vendor/Vendor');
        // $this->renderLayout();
    }
}
