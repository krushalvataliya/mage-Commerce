<?php
$installer = $this;
$installer->startSetup();
 
$installer->createEntityTables(
  $this->getTable('kv_krushal')
);
 
$installer->addEntityType('kv_krushal_krushal',Array(
    'entity_model'          =>'kv_krushal/krushal',
    'attribute_model'       =>'',
    'table'                 =>'kv_krushal/krushal',
    'increment_model'       =>'',
    'increment_per_store'   =>'0'
));
 
$installer->installEntities();
 
$installer->endSetup();