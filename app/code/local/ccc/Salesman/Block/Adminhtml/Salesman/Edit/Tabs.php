<?php

class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('salesman')->__('Salesman Information'));
    }
    
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('salesman')->__('Salesman'),
            'title' => Mage::helper('salesman')->__('Salesman Information'),
            'content' => $this->getLayout()->createBlock('salesman/adminhtml_salesman_edit_tab_form')->toHtml(),
        ));

        $this->addTab('form_section_address', array(
            'label' => Mage::helper('salesman')->__('Address'),
            'content' => $this->getLayout()->createBlock('salesman/adminhtml_salesman_edit_tab_addresses')->toHtml(),
        ));

        $this->addTab('salesman_price', array(
            'label' => Mage::helper('salesman')->__('Price'),
            'content' => $this->getLayout()->createBlock('salesman/adminhtml_salesman_edit_tab_price')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}





    