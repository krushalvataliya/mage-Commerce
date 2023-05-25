<?php
class Kv_Brand_Model_Source_Option extends Mage_Eav_Model_Entity_Attribute_Source_Abstract implements Mage_Eav_Model_Entity_Attribute_Source_Interface
{
    public function getAllOptions()
    {
        $brands = Mage::getModel('brand/brand')->getCollection()->getItems();
        $options = array();
        foreach ($brands as $key=>$brand) {
            $options[] = array('value'=>$brand->brand_id, 'label'=>$brand->name);

        }
        return $options;
    }
}
