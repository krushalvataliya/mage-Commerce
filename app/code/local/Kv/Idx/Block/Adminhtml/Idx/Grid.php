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
 * @idx    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml customer grid block
 *
 * @idx   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Kv_Idx_Block_Adminhtml_idx_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        $this->setId('idxAdminhtmlidxGrid');
        $this->setDefaultSort('idx_id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('idx/idx')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Page_Collection */
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('product_id', array(
            'header'    => Mage::helper('idx')->__('Product Id'),
            'align'     => 'left',
            'index'     => 'product_id',
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('idx')->__('Sku'),
            'align'     => 'left',
            'index'     => 'sku',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('idx')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        $this->addColumn('price', array(
            'header'    => Mage::helper('idx')->__('Price'),
            'align'     => 'left',
            'index'     => 'price',
        ));

        $this->addColumn('cost', array(
            'header'    => Mage::helper('idx')->__('Cost'),
            'align'     => 'left',
            'index'     => 'cost',
        ));

        $this->addColumn('quantity', array(
            'header'    => Mage::helper('idx')->__('Quantity'),
            'align'     => 'left',
            'index'     => 'quantity',
        ));

        $this->addColumn('brand', array(
            'header'    => Mage::helper('idx')->__('Brand'),
            'align'     => 'left',
            'index'     => 'brand',
        ));

        $this->addColumn('brand_id', array(
            'header'    => Mage::helper('idx')->__('Brand_id'),
            'align'     => 'left',
            'index'     => 'brand_id',
        ));

        $this->addColumn('collection', array(
            'header'    => Mage::helper('idx')->__('Collection'),
            'align'     => 'left',
            'index'     => 'collection',
        ));

        $this->addColumn('collection_id', array(
            'header'    => Mage::helper('idx')->__('Collection_id'),
            'align'     => 'left',
            'index'     => 'collection_id',
        ));

        $this->addColumn('description', array(
            'header'    => Mage::helper('idx')->__('Description'),
            'align'     => 'left',
            'index'     => 'description',
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('idx')->__('Status'),
            'align'     => 'left',
            'index'     => 'status',
            'renderer' => 'Kv_Idx_Block_Adminhtml_Idx_Grid_Renderer_Status'
        ));

        return parent::_prepareColumns();
    }

    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('idx_id' => $row->getId()));
    }
   
}