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
 * Adminhtml vendor grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Kv_Vendor_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        // $this->setTemplate('vendor/grid.phtml');
        $this->setId('vendorAdminhtmlVendorGrid');
        $this->setDefaultSort('vendor_id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('vendor/vendor')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Page_Collection */
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('first_name', array(
            'header'    => Mage::helper('vendor')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        $this->addColumn('mobile', array(
            'header'    => Mage::helper('vendor')->__('mobile'),
            'align'     => 'left',
            'index'     => 'mobile'
        ));
        $this->addColumn('status', array(
            'header'    => Mage::helper('vendor')->__('status'),
            'align'     => 'left',
            'renderer'  =>'Kv_Vendor_Block_Adminhtml_Vendor_Grid_Renderer_Status',
            'index'     => 'status' 
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('vendor')->__('Email'),
            'align'     => 'left',
            'index'     => 'email'
        ));

        return parent::_prepareColumns();
    }

    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('vendor_id' => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('vendor');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('vendor')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('vendor')->__('Are you sure?')
        ));

         $this->getMassactionBlock()->addItem('update_status', array(
            'label' => Mage::helper('vendor')->__('Update Status'),
            'url' => $this->getUrl('*/*/massStatusUpdate'),
            'confirm' => Mage::helper('vendor')->__('Are you sure you want to update the status?'),
            'additional' => array(
                'status' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('vendor')->__('Status'),
                    'values' => array(
                        array(
                            'value' => '1',
                            'label' => Mage::helper('vendor')->__('Active')
                        ),
                        array(
                            'value' => '2',
                            'label' => Mage::helper('vendor')->__('Inactive')
                        )
                    )
                )
            )
        ));


        // $this->getMassactionBlock()->addItem('newsletter_subscribe', array(
        //      'label'    => Mage::helper('vendor')->__('Subscribe to Newsletter'),
        //      'url'      => $this->getUrl('*/*/massSubscribe')
        // ));

        // $this->getMassactionBlock()->addItem('newsletter_unsubscribe', array(
        //      'label'    => Mage::helper('vendor')->__('Unsubscribe from Newsletter'),
        //      'url'      => $this->getUrl('*/*/massUnsubscribe')
        // ));

        // $groups = $this->helper('vendor')->getGroups()->toOptionArray();

        // array_unshift($groups, array('label'=> '', 'value'=> ''));
        // $this->getMassactionBlock()->addItem('assign_group', array(
        //      'label'        => Mage::helper('vendor')->__('Assign a vendor Group'),
        //      'url'          => $this->getUrl('*/*/massAssignGroup'),
        //      'additional'   => array(
        //         'visibility'    => array(
        //              'name'     => 'group',
        //              'type'     => 'select',
        //              'class'    => 'required-entry',
        //              'label'    => Mage::helper('vendor')->__('Group'),
        //              'values'   => $groups
        //          )
        //     )
        // ));

        return $this;
    }
   
}