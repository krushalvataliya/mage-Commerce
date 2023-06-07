<?php

class Kv_Brand_ViewController extends Mage_Core_Controller_Front_Action
{
    /**
     * @deprecated after 1.3.2.3
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Test'));
        $block = $this->getLayout()->createBlock('Kv_Brand_Block_View','test');
        $this->renderLayout();
    }
}
