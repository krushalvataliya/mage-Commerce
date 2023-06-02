<?php

class Kv_Banner_Block_Adminhtml_Bannergroup_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('banner')->__('banner Information'));
    }
    
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('banner')->__('banner group'),
            'title' => Mage::helper('banner')->__('banner group'),
            'content' => $this->getLayout()->createBlock('banner/adminhtml_bannergroup_edit_tab_form')->toHtml(),
        ));

        // $this->addTab('image_section', array(
        //     'label' => Mage::helper('banner')->__('banner'),
        //     'title' => Mage::helper('banner')->__('banner'),
        //     'content' => $this->getLayout()->createBlock('banner/adminhtml_bannergroup_edit_tab_banners')->toHtml(),
        // ));


        $product = new Mage_Catalog_Model_Product();
        $product->load(34);
        $attributes = $product->getAttributes(10, true);
        $group = new Mage_Eav_Model_Entity_Attribute_Group();
        $group->load(10);
        $this->addTab('banner_section', array(
            'label'     => Mage::helper('catalog')->__('Banners'),
            'content'   => $this->getLayout()->createBlock('banner/adminhtml_bannergroup_edit_tab_banner',
                'banner.adminhtml.bannergroup.edit.tab.banner')->setGroup($group)
                    ->setGroupAttributes($attributes)
                    ->toHtml()
        ));

        return parent::_beforeToHtml();
    }
}





    