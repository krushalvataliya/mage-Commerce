<?php
class Kv_Banner_Block_Adminhtml_Bannergroup_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        $this->setId('bannerAdminhtmlbannergroupGrid');
        $this->setDefaultSort('group_id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('banner/group')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Page_Collection */
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('group_id', array(
            'header'    => Mage::helper('group')->__('Group ID'),
            'align'     => 'left',
            'index'     => 'group_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('group')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        $this->addColumn('group_key', array(
            'header'    => Mage::helper('group')->__('Group Key'),
            'align'     => 'left',
            'index'     => 'group_key',
        ));

        $this->addColumn('height', array(
            'header'    => Mage::helper('group')->__('Height'),
            'align'     => 'left',
            'index'     => 'height',
        ));

        $this->addColumn('width', array(
            'header'    => Mage::helper('group')->__('Width'),
            'align'     => 'left',
            'index'     => 'width',
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('group')->__('Created At'),
            'align'     => 'left',
            'index'     => 'created_at',
        ));
        return parent::_prepareColumns();
    }


    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('banner_id' => $row->getId()));
    }
   
}