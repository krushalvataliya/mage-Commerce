<?php
class Kv_Idx_Model_Resource_Idx_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define resource model
     *
     */
    protected function _construct()
    {
        $this->_init('idx/idx');
    }
}