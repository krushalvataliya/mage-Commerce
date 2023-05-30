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
}
