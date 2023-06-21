<?php
class Ccc_Practice_Block_Adminhtml_Seven_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        $this->setId('PracticeAdminhtmlPracticeGrid');
    }

    protected function _prepareCollection()
    {
       $orderStatuses = array(
            'pending',
            'processing',
            'complete',
            'closed',
            'canceled',
            'holded',
            'payment_review',
        );

        $collection = Mage::getModel('sales/order')->getCollection()
            ->addFieldToSelect(array('entity_id', 'customer_id'))
            ->addFieldToFilter('main_table.status', array('in' => $orderStatuses));

        $collection->getSelect()->join(
            array('status' => Mage::getSingleton('core/resource')->getTableName('sales/order_status')),
            'status.status = main_table.status',
            array('order_status' => 'status.label')
        );

        $collection->getSelect()->join(
            array('customer' => Mage::getSingleton('core/resource')->getTableName('customer/entity')),
            'customer.entity_id = main_table.customer_id',
            array('email' => 'customer.email')
        );
        $result = array();

        foreach ($collection as $order) {
            $result[] = array(
                'order_id' => $order->getEntityId(),
                'customer_id' => $order->getCustomerId(),
                'order_status' => $order->getOrderStatus(),
                'email' => $order->getEmail(),        
            );
        }

        $collection = new Varien_Data_Collection();

        foreach ($result as $data) {
            $item = new Varien_Object($data);
            $collection->addItem($item);
        }

        $this->setCollection($collection);

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
            'renderer'  =>'ccc_practice_block_adminhtml_seven_renderer_name'
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('category')->__('email'),
            'align'     => 'left',
            'index'     => 'email',
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('category')->__('status'),
            'align'     => 'left',
            'index'     => 'order_status',
        ));

        $this->addColumn('order_count', array(
            'header'    => Mage::helper('category')->__('order count'),
            'align'     => 'left',
            'renderer'  => 'ccc_practice_block_adminhtml_seven_renderer_ordercount',

        ));

        return parent::_prepareColumns();
    }
   
   
}