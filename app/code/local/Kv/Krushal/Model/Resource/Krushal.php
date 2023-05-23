<?php

class Kv_Krushal_Model_Resource_Krushal extends Mage_Eav_Model_Entity_Abstract
{
	public function __construct()
    {
        $this->_init('kv_krushal/krushal', 'u_id');
        $resource = Mage::getSingleton('core/resource');
        $this->setType('Kv_krushal_krushal');
        $this->setConnection(
            $resource->getConnection('krushal_read'),
            $resource->getConnection('krushal_write')
        );
    }

    protected function _getDefaultAttributes()
    {
        return array(
            'entity_type_id',
            'attribute_set_id',
            'created_at',
            'updated_at',
            'increment_id',
            'store_id',
            'website_id'
        );
    }
 
}