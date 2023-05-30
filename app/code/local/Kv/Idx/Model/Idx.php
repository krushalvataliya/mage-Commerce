 <?php

class Kv_Idx_Model_Idx extends Mage_Core_Model_Abstract
{
    function __construct()
    {
        $this->_init('idx/idx');
    }

    public function updateBrandTable($data)
    {
        $brandCollection = Mage::getModel('brand/brand')->getCollection();
        $brandNames = $brandCollection->getConnection()
            ->fetchPairs($brandCollection->getSelect()->columns(['brand_id','name']));
        $newBrands = array_diff($data, $brandNames);
        foreach ($newBrands as $name) {
            $prepareData[] = ['name'=>$name];
        }
             if($prepareData){
             $resource = Mage::getSingleton('core/resource');
            $tableName = $resource->getTableName('brand');
            $writeConnection = $resource->getConnection('core_write');
            $writeConnection->insertMultiple($tableName, $prepareData);
        }
        return true;
    }

    public function updateCollectionTable($data)
    {
        $collection = Mage::getModel('collection/collection')->getCollection();
        $collectionNames = $collection->getConnection()
            ->fetchPairs($collection->getSelect()->columns(['collection_id','name']));
        $newCollections = array_diff($data, $collectionNames);
        foreach ($newCollections as $name) {
            $prepareData[] = ['name'=>$name];
        }
             if($prepareData){
             $resource = Mage::getSingleton('core/resource');
            $tableName = $resource->getTableName('collection');
            $writeConnection = $resource->getConnection('core_write');
            $writeConnection->insertMultiple($tableName, $prepareData);
        }
        return true;
    }

    public function checkBrand()
    {
        $idxBrandId = $this->getData('brand_id');
        if (!$idxBrandId) {
            return false;
        }
        return true;
    }

    public function checkCollection()
    {
        $idxCollectionId = $this->getData('collection_id');
        if (!$idxCollectionId) {
            return false;
        }
        return true;
    }

    public function updateMainProduct($idxSkus)
    {

        $productCollection = Mage::getModel('product/product')->getCollection();
        foreach ($productCollection as $product) {
            $productSkus[$product->getData('product_id')] = $product->getData('sku');
        }

        $newProducts = array_diff($idxSkus, $productSkus);

        $data = null;
        foreach ($newProducts as $sku) {
            $model = Mage::getModel('idx/idx')->load($sku,'sku');
            $data[] = [
                'sku'=>$sku,
                'name'=>$model->name,
                'cost'=>$model->cost,
                'price'=>$model->price,
                'created_time'=>now()
            ];
        }

        if($data){
            $resource = Mage::getSingleton('core/resource');
            $tableName = $resource->getTableName('product');
            $writeConnection = $resource->getConnection('core_write');
            $writeConnection->insertMultiple($tableName, $data);
        }

        $productCollection = Mage::getModel('product/product')->getCollection();
        foreach ($productCollection as $product) {
            $productSkus[$product->getData('product_id')] = $product->getData('sku');
        }
        return $productSkus;    
    }
}
