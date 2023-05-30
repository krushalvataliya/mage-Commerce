<?php

class Kv_idx_Block_Adminhtml_idx extends Mage_Adminhtml_Block_Widget_Grid_Container
{

   
    public function __construct()
    {
        
        $this->_blockGroup = 'idx';
        $this->_controller = 'adminhtml_idx';
        $this->_headerText = Mage::helper('idx')->__('Manage product Idx');

        parent::__construct();

        if ($this->_isAllowedAction('save')) {
            $this->_updateButton('add', 'label', Mage::helper('idx')->__('Add New idx'));

            $this->_addButton('import', array(
                'label'   => 'Import Product',
                'onclick' => 'setLocation(\'' . $this->getUrl('*/*/import') . '\')',
            ));

             $this->_addButton('brand', array(
                'label'   => 'Brand',
                'onclick' => 'setLocation(\'' . $this->getUrl('*/*/brand') . '\')',
            ));
            $this->_addButton('collection', array(
                'label'   => 'Collection',
                'onclick' => 'setLocation(\'' . $this->getUrl('*/*/collection') . '\')',
            ));
              $this->_addButton('product', array(
                'label'   => 'Product',
                'onclick' => 'setLocation(\'' . $this->getUrl('*/*/product') . '\')',
            ));
            // $this->_removeButton('add');
        } else {
            $this->_removeButton('add');
        }

    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('idx/adminhtml_idx/' . $action);
    }

}