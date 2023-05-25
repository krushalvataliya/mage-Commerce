<?php

class Kv_brand_Block_Adminhtml_brand extends Mage_Adminhtml_Block_Widget_Grid_Container
{

   
    public function __construct()
    {
        
        $this->_blockGroup = 'brand';
        $this->_controller = 'adminhtml_brand';
        $this->_headerText = Mage::helper('brand')->__('Manage Brands');

        parent::__construct();

        if ($this->_isAllowedAction('save')) {
            $this->_updateButton('add', 'label', Mage::helper('brand')->__('Add New brand'));
        } else {
            $this->_removeButton('add');
        }

    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('brand/adminhtml_brand/' . $action);
    }

}