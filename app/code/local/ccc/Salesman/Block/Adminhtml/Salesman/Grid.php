<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml salesman grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Ccc_Salesman_Block_Adminhtml_Salesman_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        // $this->setTemplate('vendor/grid.phtml');
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

        $this->addColumn('first_name', array(
            'header'    => Mage::helper('salesman')->__('First Name'),
            'align'     => 'left',
            'index'     => 'first_name',
        ));

        $this->addColumn('last_name', array(
            'header'    => Mage::helper('salesman')->__('Last Name'),
            'align'     => 'left',
            'index'     => 'last_name'
        ));

        $this->addColumn('gender', array(
            'header'    => Mage::helper('salesman')->__('Gender'),
            'align'     => 'left',
            'index'     => 'gender',
            'renderer'  => 'Ccc_Salesman_Block_Adminhtml_Salesman_Grid_renderer_gender'
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('salesman')->__('Email'),
            'align'     => 'left',
            'index'     => 'email'
        ));

        $this->addColumn('company', array(
            'header'    => Mage::helper('salesman')->__('Company'),
            'align'     => 'left',
            'index'     => 'company'
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