<?php

class Kv_Krushal_Block_Adminhtml_Krushal_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('krushal')->__('Krushal Information'));
    }
    
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('krushal')->__('Krushal'),
            'title' => Mage::helper('krushal')->__('Krushal Information'),
            'content' => $this->getLayout()->createBlock('krushal/adminhtml_krushal_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}





    