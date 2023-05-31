 <?php

class Kv_Idx_Model_Idx extends Mage_Core_Model_Abstract
{
    function __construct()
    {
        $this->_init('idx/idx');
    }

    public function insertOnDuplicate($data,$fields)
    {
        $resource = Mage::getSingleton('core/resource');
        $connection = $resource->getConnection('core_write');
        $table = $resource->getTableName('import_product_idx');
        return $connection->insertOnDuplicate($table, $data, $fields);
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

    public function updateCollectionAttribute($data)
    {
        try {
            $attributeCode = 'collection';
            $attribute = Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product', $attributeCode);

            $options = $attribute->getSource()->getAllOptions();
            $existOption = array_filter(array_column($options,'label'));

            $newOptions = array_diff($data, $existOption);
            print_r($data);
            print_r($newOptions);
            // die();
            if($newOptions){
                $option['attribute_id'] = $attribute->getId();
                foreach ($newOptions as $key => $value) {
                    $option['value'] = array(0 => array($value));
                    $option['lable'] = $value;
                    // $attribute->setData('option', $option);
                    // $attribute->save();
                     $setup = new Mage_Eav_Model_Entity_Setup('core_setup');
                    $setup->addAttributeOption($option);
                }
            }
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError('Error:'.$e);
        }
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

    public function updateProductAttribute($idxProductData)
    {
        $product = Mage::getModel('catalog/product')->getCollection();

            $skuArray = $product->getData();
            $productSkus = array_column($skuArray, 'sku');

            $idxSkuData = array_column($idxProductData, 'sku');

        $newProducts = array_diff($idxSkuData, $productSkus);

            print_r($newProducts);
        print_r($idxProductData);
        $entityTypeId = Mage::getModel('catalog/product')->getResource()->getTypeId();
        print_r($entityTypeId);

        foreach ($idxProductData as $item) {
            if(in_array($item['sku'], $newProducts))
            {
                $product = Mage::getModel('catalog/product');
                $product->setTypeId('simple')
                    ->setSku($item['sku']) // Assuming attribute_code_1 is used for SKU
                    ->setAttributeSetId(4)
                    ->setWebsiteIds(array(0))
                    ->setStatus(Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
                    ->setEntityTypeId($entityTypeId)
                    ->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)
                    ->setStockData(array(
                        'is_in_stock' => 1,
                        'qty' => $item['quantity']),
                    );
                    // die;

                unset($item['idx_id']);
                unset($item['sku']);
                unset($item['quantity']);
                    print_r($item);
                $product->save();
               foreach ($item as $attributeCode => $value) {
                $attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
                $attributeId = $attribute->getAttributeId();

                $product->setData($attributeCode, $value);
                echo "string";
                $product->getResource()->saveAttribute($product, $attributeCode);
                }

            // $product->save();
            }
        }
    }
}
