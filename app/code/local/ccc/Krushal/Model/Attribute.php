<?php

class Ccc_Krushal_Model_Attribute extends Mage_Eav_Model_Attribute
{
    const MODULE_NAME = 'Ccc_Krushal';
    protected $_eventObject = 'attribute';

    protected function _construct()
    {
        $this->_init('krushal/attribute');
    }
}