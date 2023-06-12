<?php

class Ccc_Category_Block_Category extends Mage_Core_Block_Template
{
    function __construct()
    {
        parent::__construct();
    }


    public function getFeaturedCatagories()
    {
        $attributeCode = 'featured_category';
        $attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_category', $attributeCode);
        $optionId = $attribute->getSource()->getOptionId('Yes');

        return Mage::getModel('catalog/category')
        ->getCollection()
        ->addAttributeToSelect('*')
        ->addAttributeToFilter('featured_category', array('eq' => $optionId));
    }
}
