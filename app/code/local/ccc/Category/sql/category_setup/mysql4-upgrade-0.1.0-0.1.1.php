<?php

$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$installer->addAttribute('catalog_category', 'featured_category', array(
    'group'                       => 'General Information',
    'source'                      => 'eav/entity_attribute_source_boolean',
    'type'                        => 'int',
    'backend'                     => '',
    'frontend'                    => '',
    'input'                       => 'select',
    'label'                       => 'Featured Category',
    'class'                       => '',
    'sort_order'                  => '100',
    'visible'                     => 1,
    'required'                    => 0,
    'user_defined'                => 1,
    'searchable'                  => 1,
    'filterable'                  => 1,
    'visible_on_front'            => 1,
    'visible_in_advanced_search'  => 0,
    'is_html_allowed_on_front'    => 1,
    'comparable'                  => ''
));

$installer->endSetup();
