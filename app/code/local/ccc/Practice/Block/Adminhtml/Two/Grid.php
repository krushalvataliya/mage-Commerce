<?php
class Ccc_Practice_Block_Adminhtml_Two_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        $this->setId('PracticeAdminhtmlPracticeGrid');
    }

    protected function _prepareCollection()
    {
        // $attributeCollection = Mage::getResourceModel('eav/entity_attribute_collection');
        // $attributeOptionCollection = Mage::getResourceModel('eav/entity_attribute_option_collection');

        // $attributeOptionCollection->getSelect()
        //     ->join(
        //         array('attribute' => $attributeCollection->getTable('eav/attribute')),
        //         'attribute.attribute_id = main_table.attribute_id',
        //         array('attribute_code' => 'attribute.attribute_code')
        //     );

        // $attributeOptionCollection->getSelect()
        //     ->joinLeft(array('ao'=> $attributeCollection->getTable('eav/attribute_option_value')),
        //         'main_table.option_id = ao.option_id AND ao.store_id = 0',
        //         array()
        //         );

        // $attributeOptionCollection->getSelect()->columns(array(
        //     'attribute_id' => 'main_table.attribute_id',
        //     'attribute_code' => 'attribute.attribute_code',
        //     'option_id' => 'main_table.option_id',
        //     'option_name'=>'ao.value'
        // ));
        $attributeOptionArray = Mage::getModel('practice/practice')->getAttributeArrayWithOption();
        $collection = new Varien_Data_Collection();

        foreach ($attributeOptionArray as $data) {
            $item = new Varien_Object($data);
            $collection->addItem($item);
        }
        // print_r($attributeOptionCollection->count());
        /* @var $collection Mage_Cms_Model_Mysql4_Page_Collection */
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('attribute_id', array(
            'header'    => Mage::helper('category')->__('Attribute Id'),
            'align'     => 'left',
            'index'     => 'attribute_id',
        ));

        $this->addColumn('attribute_code', array(
            'header'    => Mage::helper('category')->__('Attribute Code'),
            'align'     => 'left',
            'index'     => 'attribute_code',
        ));

        $this->addColumn('option_id', array(
            'header'    => Mage::helper('category')->__('Option Id'),
            'align'     => 'left',
            'index'     => 'option_id',
        ));

        $this->addColumn('oprion_name', array(
            'header'    => Mage::helper('category')->__('Option Name'),
            'align'     => 'left',
            'index'     => 'option_name',
        ));

        return parent::_prepareColumns();
    }
   
}