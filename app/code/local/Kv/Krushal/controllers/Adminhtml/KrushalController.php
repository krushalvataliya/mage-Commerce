<?php

class Kv_Krushal_Adminhtml_KrushalController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('krushal'))
             ->_title($this->__('krushal'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('kv_krushal/adminhtml_krushal'));
        $this->renderLayout();
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('krushal/krushal')
            ->_addBreadcrumb(Mage::helper('krushal')->__('Krushal Manager'), Mage::helper('krushal')->__('Krushal Manager'))
            ->_addBreadcrumb(Mage::helper('krushal')->__('Manage Krushal'), Mage::helper('krushal')->__('Manage Krushal'))
        ;
        return $this;
    }

    public function createAction()
    {
        $installer = new Mage_Eav_Model_Entity_Setup('core_setup');
        $installer->startSetup();
        $installer->addAttribute('krushal', 'example_attribute', array(
        'group' => 'General', // Attribute group
        'type' => 'varchar', // Attribute data type
        'backend' => '', // Attribute backend model (if any)
        'frontend' => '', // Attribute frontend model (if any)
        'label' => array('Example Attribute'),
        'input' =>  'text',
        'global' => 'text',
        'visible' => 1,
        'required' => 0,
        'user_defined' => 1,
        'default' => '',
        'option' =>  array( 
                'value' => array(
                    'option_1' => array('Option 1'),
                    'option_2' => array('Option 2'),
                    'option_3' => array('Option 3')
                )), 

        'validate_rules' =>'a:2:{s:15:"max_text_length";i:255;s:15:"min_text_length";i:0;}', 
        'is_configurable' => false, // Configurable product (0 - No, 1 - Yes)
        'is_searchable' => false, // Used in Quick Search (0 - No, 1 - Yes)
        'is_filterable' => false, // Used in Layered Navigation (0 - No, 1 - Yes)
        'apply_to' =>implode(',', array('simple', 'configurable', 'virtual')),
    ));
    $installer->endSetup();

    echo "Attribute created successfully!";
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_addContent($this->getLayout()->createBlock('kv_krushal/adminhtml_krushal_edit'))
                ->_addLeft($this->getLayout()->createBlock('kv_krushal/adminhtml_krushal_edit_tabs'));

        $this->renderLayout();
    }


    // public function indexAction()
    //  echo 11;
    //     $post = Mage::getModel('kv_krushal/krushal');
    //     $post->setTitle('Test title');
    //     $post->setAuthor('Zoran Šalamun');
    //     $post->save();

    //     $post = Mage::getModel('kv_krushal/krushal');
    //     $post->setBookType('Test title');
    //     $post->save();

    //     $posts = Mage::getModel('kv_krushal/krushal')->getCollection();
    //     $posts->load();
    //     var_dump($posts);

    //     $posts = Mage::getModel('kv_krushal/krushal')->getCollection()
    //             ->addAttributeToSelect('title')
    //             ->addAttributeToSelect('author');
    //     $posts->load();
    //     var_dump($posts);

    //     $post = Mage::getModel('kv_krushal/krushal')->load(1);
    //     var_dump($post);
    // }
}