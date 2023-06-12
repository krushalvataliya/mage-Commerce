 <?php
class Ccc_Category_Model_Observer extends Mage_Core_Model_Abstract
{
    public function generateCategoryUrlRewrite(Varien_Event_Observer $observer)
    {
        $category = $observer->getEvent()->getCategory();
        $storeId = $category->getStoreId();
        $categoryId = $category->getId();
        // $requestPath = $category->getName();
        $requestPath = $category->getUrlKey();
        Mage::log($requestPath,null,'gddddddw.log');

        $urlRewrite = Mage::getModel('core/url_rewrite')
        // ->setId($categoryId);
        ->loadByIdPath('cat/'. $categoryId);
        Mage::log($urlRewrite,null,'gddddd.log');
        // if ($urlRewrite && $urlRewrite->getId()) {
        //     // $urlRewrite->setRequestPath($requestPath);
        //     // $urlRewrite->save();
        //     $existingRewrite->delete();
        // } else {
            $urlRewrite->setIsSystem(0)
                        ->setStoreId($storeId)
                        ->setIdPath('cat/'. $categoryId)
                        ->setTargetPath('category/view/index/id/' . $categoryId)
                        ->setRequestPath($requestPath)
                        ->setIsSystem(0)
                        ->setOptions('')
                        ->setDescription('');
        // }

        $urlRewrite->save();
    }
}