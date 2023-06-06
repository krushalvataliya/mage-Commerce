<?php

class Kv_banner_Block_Adminhtml_Bannergroup extends Mage_Adminhtml_Block_Widget_Grid_Container
{

   
    public function __construct()
    {
        
        $this->_blockGroup = 'banner';
        $this->_controller = 'adminhtml_Bannergroup';
        $this->_headerText = Mage::helper('group')->__('Manage Banners');

        parent::__construct();

        if ($this->_isAllowedAction('save')) {
            $this->_updateButton('add', 'label', Mage::helper('group')->__('Add New group'));
        } else {
            $this->_removeButton('add');
        }

    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('banner/adminhtml_Bannergroup/' . $action);
    }

}