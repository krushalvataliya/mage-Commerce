<?php
class Kv_Krushal_Block_Adminhtml_Krushal_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        // $this->setTemplate('vendor/grid.phtml');
        $this->setId('salesmanAdminhtmlsalesmanGrid');
        $this->setDefaultSort('u_id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('kv_krushal/krushal')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Page_Collection */
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('u_id', array(
            'header'    => Mage::helper('krushal')->__('id'),
            'align'     => 'left',
            'index'     => 'u_id',
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('krushal')->__('Status'),
            'align'     => 'left',
            'index'     => 'status'
        ));

        $this->addColumn('type', array(
            'header'    => Mage::helper('krushal')->__('Type'),
            'align'     => 'left',
            'index'     => 'type'
        ));


        // $this->addColumn('action',
        //     array(
        //         'header'    =>  Mage::helper('salesman')->__('Action'),
        //         'width'     => '100',
        //         'type'      => 'action',
        //         'getter'    => 'getId',
        //         'actions'   => array(
        //             array(
        //                 'caption'   => Mage::helper('salesman')->__('PRICE'),
        //                 'url'       => array('base'=> '*/*/price'),
        //                 'field'     => 'salesman_id'
        //             )
        //         ),
        //         'filter'    => false,
        //         'sortable'  => false,
        //         'index'     => 'stores',
        //         'is_system' => true,
        // ));

        return parent::_prepareColumns();
    }



    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('salesman_id' => $row->getId()));
    }
   
}