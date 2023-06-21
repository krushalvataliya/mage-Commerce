<?php
class Ccc_Practice_Block_Adminhtml_Three_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        $this->setId('PracticeAdminhtmlPracticeGrid');
    }

    protected function _prepareCollection()
    {
           $attributeOptionCollection = Mage::getResourceModel('eav/entity_attribute_option_collection')
                ->addFieldToFilter('option_id', array('gt' => 0))
                ->getSelect()
                ->join(
                    array('attribute' => Mage::getSingleton('core/resource')->getTableName('eav/attribute')),
                    'attribute.attribute_id = main_table.attribute_id',
                    array('attribute_code' => 'attribute.attribute_code')
                )
                    ->joinLeft(
                        array('source' => Mage::getSingleton('core/resource')->getTableName('brand')),
                        'source.brand_id = main_table.option_id',
                        array()
                    )
                ->columns(array('option_count' => new Zend_Db_Expr('COUNT(main_table.option_id)')))
                ->group('main_table.attribute_id')
                ->having('option_count > ?', 1);

            $resultCollection = Mage::getModel('eav/entity_attribute')->getCollection();
            $resultCollection->getSelect()->reset()->from(array('main_table' => $attributeOptionCollection));

        $attributeOptionArray = Mage::getModel('practice/practice')->getAttributeArrayWithOptionCount();

        $collection = new Varien_Data_Collection();
        foreach ($attributeOptionArray as $data) {
            $item = new Varien_Object($data);
            if($data['option_count'] > 1){
                $collection->addItem($item);
            }
        }

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('attribute_id', array(
            'header'    => Mage::helper('category')->__('attribute_id'),
            'align'     => 'left',
            'index'     => 'attribute_id',
        ));

        $this->addColumn('attribute_code', array(
            'header'    => Mage::helper('category')->__('attribute_code'),
            'align'     => 'left',
            'index'     => 'attribute_code',
        ));

        $this->addColumn('option_count', array(
            'header'    => Mage::helper('category')->__('option_count'),
            'align'     => 'left',
            'index'     => 'option_count',
        ));

        return parent::_prepareColumns();
    }
   
}