<?php
class Ccc_Practice_Block_Adminhtml_Six_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        $this->setId('PracticeAdminhtmlPracticeGrid');
    }

    protected function _prepareCollection()
    {

        $customerCollection = Mage::getModel('customer/customer')->getCollection();
        $customerCollection->addAttributeToSelect(array('entity_id', 'firstname', 'lastname', 'email'));
        $query = $customerCollection->getSelect()->joinLeft(
            array('o' => Mage::getSingleton('core/resource')->getTableName('sales/order')),
            'o.customer_id = e.entity_id',
            array('order_count' => 'COUNT(o.entity_id)')
        )
        ->group('e.entity_id')
        ->order(array('order_count DESC'));

        $this->setCollection($customerCollection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('customer_id', array(
            'header'    => Mage::helper('category')->__('customer_id'),
            'align'     => 'left',
            'index'     => 'entity_id',
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
            // 'renderer'  => 'ccc_practice_block_adminhtml_six_renderer_ordercount'
        ));


        return parent::_prepareColumns();
    }
   
}