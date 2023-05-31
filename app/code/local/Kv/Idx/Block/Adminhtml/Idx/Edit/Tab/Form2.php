<?php

class Kv_idx_Block_Adminhtml_idx_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('idx_form',array('legend'=>Mage::helper('idx')->__('Idx information')));

        $fieldset->addField('sku', 'text', array(
            'label' => Mage::helper('idx')->__('Sku'),
            'input'     => 'number',
            'required' => false,
            'name' => 'sku',
        ));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('idx')->__('Name'),
            'required' => false,
            'name' => 'name',
        ));

        $fieldset->addField('price', 'text', array(
            'label' => Mage::helper('idx')->__('Price'),
            'input'     => 'number',
            'class'     => 'validate-number',
            'required' => false,
            'name' => 'price',
        ));

        $fieldset->addField('cost', 'text', array(
            'label' => Mage::helper('idx')->__('Cost'),
            'input'     => 'number',
            'class'     => 'validate-number',
            'required' => false,
            'name' => 'cost',
        ));

        $fieldset->addField('quantity', 'text', array(
            'label' => Mage::helper('idx')->__('Quantity'),
            'input'     => 'number',
            'class'     => 'validate-number',
            'required' => false,
            'name' => 'quantity',
        ));

        $fieldset->addField('brand', 'text', array(
            'label' => Mage::helper('idx')->__('Brand'),
            'required' => false,
            'name' => 'brand',
        ));

        $fieldset->addField('collection', 'text', array(
            'label' => Mage::helper('idx')->__('Collection'),
            'required' => false,
            'name' => 'collection',
        ));

        $fieldset->addField('description', 'text', array(
            'label' => Mage::helper('idx')->__('Description'),
            'required' => false,
            'name' => 'description',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('idx')->__('Status'),
            'required' => false,
            'name' => 'status',
            'options'=> array(
                1 => "Active",
                2 => "Inactive",
            ),

        ));

        if ( Mage::getSingleton('adminhtml/session')->getidxData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getidxData());
            Mage::getSingleton('adminhtml/session')->setidxData(null);
        } elseif ( Mage::registry('idx_edit') ) {
            $form->setValues(Mage::registry('idx_edit')->getData());
        }
        return parent::_prepareForm();


    }

}





    