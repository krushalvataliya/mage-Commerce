<?php
class Ccc_Practice_Block_Adminhtml_Seven_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        $this->setId('PracticeAdminhtmlPracticeGrid');
        $this->setDefaultSort('order_count');
        $this->setDefaultDir('ASC');
    }

     protected function _prepareCollection()
    {
        // $collection = Mage::getModel('customer/customer')->getCollection()
        // ->addAttributeToSelect('*');
        // $this->setCollection($collection);


        $collection = Mage::getModel('sales/order')->getCollection()
        ->addAttributeToSelect('*')
        ->addFieldToFilter('customer_id', array('notnull' => true))
        ->addFieldToFilter('state', array('neq' => Mage_Sales_Model_Order::STATE_CANCELED));
        // ->groupByAttribute('customer_id');

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('customer_id', array(
            'header'    => Mage::helper('category')->__('customer_id'),
            'align'     => 'left',
            'index'     => 'customer_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('category')->__('name'),
            'align'     => 'left',
            'index'     => 'name',
            'renderer'  =>'ccc_practice_block_adminhtml_six_renderer_name'
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('category')->__('email'),
            'align'     => 'left',
            'index'     => 'email',
        ));

        $this->addColumn('order_count', array(
            'header'    => Mage::helper('category')->__('order count'),
            'align'     => 'left',
            'index'     => 'order_count',
            'renderer'  => 'ccc_practice_block_adminhtml_six_renderer_ordercount'
        ));


        return parent::_prepareColumns();
    }

    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('category_id' => $row->getId()));
    }
   
}