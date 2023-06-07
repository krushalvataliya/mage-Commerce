<?php

class 
Kv_Banner_Block_Home extends Mage_Core_Block_Template
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate('banner/homepage.phtml');
    }

}