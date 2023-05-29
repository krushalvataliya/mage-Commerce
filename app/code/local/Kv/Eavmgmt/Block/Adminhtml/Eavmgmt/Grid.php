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
 * @eavmgmt    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml customer grid block
 *
 * @eavmgmt   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Kv_Eavmgmt_Block_Adminhtml_eavmgmt_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

   protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('eavmgmt/eavmgmt_collection');
        /* @var $collection Mage_Cms_Model_Mysql4_Page_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();

    }

    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $baseUrl = $this->getUrl();

        $this->addColumn('attribute_id', array(
            'header'=>Mage::helper('eav')->__('Attribute Id'),
            'sortable'=>true,
            'index'=>'attribute_id',
        ));

        $this->addColumn('attribute_id1', array(
            'header'=>Mage::helper('eav')->__('Entity Type'),
            'sortable'=>true,
            'index'=>'attribute_id1',
            'renderer'=> 'Kv_Eavmgmt_Block_Adminhtml_eavmgmt_Csv_entityType'
        ));


        $this->addColumn('attribute_code', array(
            'header'=>Mage::helper('eav')->__('Attribute Code'),
            'sortable'=>true,
            'index'=>'attribute_code'
        ));

        $this->addColumn('frontend_label', array(
            'header'=>Mage::helper('eav')->__('Attribute Name'),
            'sortable'=>true,
            'index'=>'frontend_label'
        ));

        $this->addColumn('input_type', array(
            'header'=>Mage::helper('eav')->__('Input Type'),
            'sortable'=>true,
            'index'=>'frontend_input'
        ));

        $this->addColumn('backend_type', array(
            'header'=>Mage::helper('eav')->__('Backend Type'),
            'sortable'=>true,
            'index'=>'backend_type'
        ));

        $this->addColumn('source_model', array(
            'header'=>Mage::helper('eav')->__('Source Model'),
            'sortable'=>true,
            'index'=>'source_model'
        )); 

         $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('eavmgmt')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('eavmgmt')->__('show options'),
                        'url'       => array('base'=> '*/*/showoption'),
                        'field'     => 'eavmgmt_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
        $this->addExportType('*/*/exportCsv', Mage::helper('eavmgmt')->__('CSV'));

        return $this;

    }

    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('eavmgmt_id' => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('attribute_id');
        $this->getMassactionBlock()->setFormFieldName('attribute_id');

        $this->getMassactionBlock()->addItem('import_attribute', array(
             'label'    => Mage::helper('eavmgmt')->__('Export'),
             'url'      => $this->getUrl('*/*/selectedExport'),
             'confirm'  => Mage::helper('eavmgmt')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('import_attribute_options', array(
             'label'    => Mage::helper('eavmgmt')->__('Export Options'),
             'url'      => $this->getUrl('*/*/selectedExportOptions'),
             'confirm'  => Mage::helper('eavmgmt')->__('Are you sure?')
        ));
        return $this;
    }  
   
}