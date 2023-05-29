<?php

class Kv_Idx_Model_Import_Product_Resource_Idx extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {  
        $this->_init('idx/import_product_idx', 'idx_id');
    }  
}