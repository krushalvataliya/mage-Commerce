<?php

class Kv_Krushal_Block_Adminhtml_Krushal extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        
        $this->_blockGroup = 'kv_krushal';
        $this->_controller = 'adminhtml_krushal';
        $this->_headerText = Mage::helper('krushal')->__('Krushal');

        parent::__construct();

        if ($this->_isAllowedAction('save')) {
            $this->_updateButton('add', 'label', Mage::helper('krushal')->__('Add New krushal'));
        } else {
            $this->_removeButton('add');
        }

    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('krushal/adminhtml_krushal/' . $action);
    }

}