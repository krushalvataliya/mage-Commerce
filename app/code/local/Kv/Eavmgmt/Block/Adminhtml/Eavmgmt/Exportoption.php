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
class Kv_Eavmgmt_Block_Adminhtml_Eavmgmt_Exportoption extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{
     protected function _prepareColumns()
    {
        $this->addColumn('index', array(
            'header' => Mage::helper('eavmgmt')->__('Index'),
            'index'  => 'entity_id',
            'renderer'=> 'Kv_Eavmgmt_Block_Adminhtml_eavmgmt_Csv_Number'
        ));

        $this->addColumn('attribute_id', array(
            'header'=>Mage::helper('eav')->__('Attribute Id'),
            'sortable'=>true,
            'index'=>'attribute_id',
        ));

        $this->addColumn('attribute_id', array(
            'header'=>Mage::helper('eav')->__('Entity Type'),
            'sortable'=>true,
            'index'=>'attribute_id',
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

        $this->addColumn('option_id', array(
            'header'=>Mage::helper('eav')->__('Option Id'),
            'sortable'=>true,
            'index'=>'option_id'
        ));

         $this->addColumn('value', array(
            'header'=>Mage::helper('eav')->__('Option Name'),
            'sortable'=>true,
            'index'=>'value',
            'renderer'=> 'Kv_Eavmgmt_Block_Adminhtml_eavmgmt_Csv_entityOption'
        ));

         $this->addColumn('sort_order', array(
            'header'=>Mage::helper('eav')->__('Option Sort Order'),
            'sortable'=>true,
            'index'=>'sort_order'
        ));


        return $this;

    }
 
   
}