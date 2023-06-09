<?php
class Kv_Brand_Model_Observer
{
    public function generateBrandRewriteUrl($observer)
    {
        $brand = $observer->getBrand();
        $urlKey = $brand->getUrlKey();
        $rewrite = Mage::getModel('core/url_rewrite')->load('brand/' . $brand->getId(),'id_path');
        $rewrite->setStoreId($brand->getStoreId())
                ->setIdPath('brand/' . $brand->getId())
                ->setRequestPath('brand/' . $urlKey)
                ->setTargetPath('brand/view/index/brand_id/'. $brand->getId())
                ->setIsSystem(0)
                ->setOptions('')
                ->setDescription('')
                ->save();
    }
}
