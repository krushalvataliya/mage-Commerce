<?php
class Kv_Banner_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        // $block = $this->getLayout()->getBlock('content');
        // print_r($block);
        // ;//->append($this->getLayout()->createBlock('banner/home'));
    }
}
