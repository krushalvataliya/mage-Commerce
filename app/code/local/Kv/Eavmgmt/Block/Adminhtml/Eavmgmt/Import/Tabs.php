<?php

class Kv_Eavmgmt_Block_Adminhtml_Eavmgmt_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('eavmgmt')->__('eavmgmt Information'));
    }
    
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('eavmgmt')->__('Import Attribute'),
            'title' => Mage::helper('eavmgmt')->__('eavmgmt Information'),
            'content' => $this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}





    