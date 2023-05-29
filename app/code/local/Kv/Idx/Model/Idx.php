 <?php

class Kv_Idx_Model_Idx extends Mage_Core_Model_Abstract
{
    function __construct()
    {
        $this->_init('idx/idx');
    }

    public function updateBrandTable($data)
    {
        $brandModel = Mage::getModel('brand/brand');
        $collection =$brandModel->getCollection();
        $CollectionArray = $collection->getData();
        $BrandNames = array_column($CollectionArray,'name');

            $newBrands = [];
        foreach ($data as $key => $value) {
            $collection =$brandModel->getCollection();
            $collection->addFieldToFilter('name', $value);
            if(!$collection->getData())
            {
                $idxModel = Mage::getModel('brand/brand');
                $brandId = $idxModel->setData(['name' => $value])->save();
                $id = $brandId->getId();
                $newBrands[$id] = $value;
            }
        }
        return $newBrands;
    }
}
