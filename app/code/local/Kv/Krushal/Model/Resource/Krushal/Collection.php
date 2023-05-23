<?php 

class Kv_Krushal_Model_Resource_Krushal_Collection extends Mage_Eav_Model_Entity_Collection_Abstract
{
 
    protected function _construct()
    {
        $this->_init('kv_krushal/krushal');
    }
 
}