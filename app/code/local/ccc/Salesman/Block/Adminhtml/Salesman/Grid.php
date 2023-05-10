<?php

class Ccc_Salesman_Block_Adminhtml_Salesman_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        // $this->setTemplate('salesman/grid.phtml');
        $this->setId('salesmanAdminhtmlsalesmanGrid');
        $this->setDefaultSort('salesman_id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('salesman/salesman')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Page_Collection */
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('salesman_name', array(
            'header'    => Mage::helper('salesman')->__('Salesman Name'),
            'align'     => 'left',
            'index'     => 'salesman_name',
        ));

        $this->addColumn('first_name', array(
            'header'    => Mage::helper('salesman')->__('first_name'),
            'align'     => 'left',
            'index'     => 'first_name'
        ));

        $this->addColumn('last_name', array(
            'header'    => Mage::helper('salesman')->__('last_name'),
            'align'     => 'left',
            'index'     => 'last_name'
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('salesman')->__('email'),
            'align'     => 'left',
            'index'     => 'email'
        ));

        $this->addColumn('gender', array(
            'header'    => Mage::helper('salesman')->__('Gender'),
            'align'     => 'left',
            'index'     => 'gender'
        ));

        return parent::_prepareColumns();
    }

    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('salesman_id' => $row->getId()));
    }
   
}