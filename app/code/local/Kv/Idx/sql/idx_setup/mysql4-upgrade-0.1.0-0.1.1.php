<?php

$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$attributeCode = 'collection';
$attributeName = 'Collection';

$installer->addAttribute(4, $attributeCode, array(
    'group'             => 'General',
    'type'              => 'int',
    'backend'           => '',
    'frontend'          => '',
    'label'             => $attributeName,
    'input'             => 'select',
    'class'             => '',
    'source'            => '',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',
    'searchable'        => false,
    'filterable'        => false,
    'comparable'        => false,
    'visible_on_front'  => false,
    'visible_in_advanced_search' => false,
    'unique'            => false
));

$installer->endSetup();

