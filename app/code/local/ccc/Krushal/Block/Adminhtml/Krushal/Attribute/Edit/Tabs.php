<?php

class Ccc_Krushal_Block_Adminhtml_Krushal_Attribute_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('krushal_attribute_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('krushal')->__('Attribute Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main', array(
            'label'     => Mage::helper('krushal')->__('Properties'),
            'title'     => Mage::helper('krushal')->__('Properties'),
            'content'   => $this->getLayout()->createBlock('krushal/adminhtml_krushal_attribute_edit_tab_main')->toHtml(),
            'active'    => true
        ));

        $model = Mage::registry('entity_attribute');

        $this->addTab('labels', array(
            'label'     => Mage::helper('krushal')->__('Manage Label / Options'),
            'title'     => Mage::helper('krushal')->__('Manage Label / Options'),
            'content'   => $this->getLayout()->createBlock('krushal/adminhtml_krushal_attribute_edit_tab_options')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}