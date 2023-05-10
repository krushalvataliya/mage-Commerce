<?php

class Ccc_Category_TestController extends Mage_Core_Controller_Front_Action
{
    /**
     * @deprecated after 1.3.2.3
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Test'));
        $block = $this->getLayout()->createBlock('Ccc_Test_Block_Test','test');
        $this->renderLayout();
    }
}
