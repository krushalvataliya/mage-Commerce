<?php

class Kv_Brand_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * @deprecated after 1.3.2.3
     */
    public function indexAction()
    {
        echo "string";
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Brands'));
        $this->renderLayout();
    }
}
