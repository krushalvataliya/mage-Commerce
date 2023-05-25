<?php 

$this->startSetup();

$this->addEntityType(Ccc_Krushal_Model_Resource_Krushal::ENTITY,[
	'entity_model'=>'krushal/krushal',
	'attribute_model'=>'krushal/attribute',
	'table'=>'krushal/krushal',
	'increment_per_store'=> '0',
	'additional_attribute_table' => 'krushal/eav_attribute',
	'entity_attribute_collection' => 'krushal/krushal_attribute_collection'
]);

$this->createEntityTables('krushal');
$this->installEntities();

$default_attribute_set_id = Mage::getModel('eav/entity_setup', 'core_setup')
    						->getAttributeSetId('krushal', 'Default');

$this->run("UPDATE `eav_entity_type` SET `default_attribute_set_id` = {$default_attribute_set_id} WHERE `entity_type_code` = 'krushal'");

$this->endSetup();