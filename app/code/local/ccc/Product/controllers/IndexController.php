<?php

class Ccc_Product_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        echo "string in Ccc_Product_IndexController";
    }
}
