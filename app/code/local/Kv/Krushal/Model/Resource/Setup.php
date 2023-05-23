<?php
 
class Kv_Krushal_Model_Resource_Setup extends Mage_Eav_Model_Entity_Setup
{
    /*
     * Setup attributes for kv_krushal_post entity type
     * -this attributes will be saved in db if you set them
     */
    public function getDefaultEntities()
    {
        $entities = array(
            'Kv_krushal_krushal' => array(
                'entity_model' => 'kv_krushal/krushal',
                'attribute_model' => '',
                'table' => 'kv_krushal/krushal',
                'attributes' => array(
                    'title' => array(
                        'type' => 'varchar',
                        'backend' => '',
                        'frontend' => '',
                        'label' => 'Title',
                        'input' => 'text',
                        'class' => '',
                        'source' => '',
                        'global' => 0,
                        'visible' => true,
                        'required' => true,
                        'user_defined' => true,
                        'default' => '',
                        'searchable' => false,
                        'filterable' => false,
                        'comparable' => false,
                        'visible_on_front' => true,
                        'unique' => false,
                    ),
                    'author' => array(
                        'type' => 'varchar',
                        'backend' => '',
                        'frontend' => '',
                        'label' => 'Author',
                        'input' => 'text',
                        'class' => '',
                        'source' => '',
                        'global' => 0,
                        'visible' => true,
                        'required' => true,
                        'user_defined' => true,
                        'default' => '',
                        'searchable' => false,
                        'filterable' => false,
                        'comparable' => false,
                        'visible_on_front' => false,
                        'unique' => false,
                    ),
                ),
            )
        );
        return $entities;
    }
}