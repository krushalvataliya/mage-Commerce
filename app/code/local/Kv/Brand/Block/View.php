<?php

class Kv_Brand_Block_View extends Mage_Core_Block_Template
{

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
    }

    public function getProductsByBrand()
    {
        $brandValue = $this->getRequest()->getParam('brand_id'); 
        $brandValue = $this->getRequest()->getParam('brand_id');
        $category = $this->getRequest()->getParam('cat');

        $brandAttributeCode = 'brand'; 
        $brandAttribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $brandAttributeCode);

        
        $productCollection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToFilter($brandAttributeCode, $brandValue)
            ->getAllIds();

        $products = Mage::getModel('catalog/product')->getCollection()
            ->addIdFilter($productCollection)
            ->addCategoryFilter(Mage::getModel('catalog/category')->load($category))
            ->addAttributeToSelect('*');
        return $products;
    }

    public function getProductUrl($product)
    {
        $productId = $product->getId(); 
        $rewrite = Mage::getModel('core/url_rewrite')->load($productId,'product_id');
        $requestPath = $rewrite->getRequestPath();
        return $requestPath;
    }

}
