<?php

class Kv_Brand_Block_View extends Mage_Core_Block_Template
{
    // }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
    }

    public function getProductsByBrand()
    {

            $brandAttributeCode = 'brand'; // Replace with your brand attribute code
            $brandAttribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $brandAttributeCode);

            $brandValue = $this->getRequest()->getParam('brand_id'); // Replace with your desired brand attribute value (integer)
            $productCollection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToFilter($brandAttributeCode, $brandValue)
                ->getAllIds();

            $products = Mage::getModel('catalog/product')->getCollection()
                ->addIdFilter($productCollection)
                ->addAttributeToSelect('*');
            return $products;
    }

}
