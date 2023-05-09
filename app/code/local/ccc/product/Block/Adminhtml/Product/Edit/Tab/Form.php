<?php

class Ccc_Product_Block_Adminhtml_Product_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('product_form',array('legend'=>Mage::helper('product')->__('product information')));

        $fieldset->addField('product_name', 'text', array(
            'label' => Mage::helper('product')->__('Name'),
            'required' => true,
            'name' => 'product_name',
        ));

        $fieldset->addField('sku','text', array(
            'label' => Mage::helper('product')->__('SKU'),
            'required' => true,
            'name' => 'sku'
        ));

        $fieldset->addField('cost','text', array(
            'label' => Mage::helper('product')->__('Cost'),
            'required' => true,
            'name' => 'cost'
        ));

        $fieldset->addField('price', 'text', array(
            'label' => Mage::helper('product')->__('Price'),
            'required' => true,
            'name' => 'price',
        ));

        $fieldset->addField('description', 'text', array(
            'label' => Mage::helper('product')->__('Description'),
            'required' => true,
            'name' => 'description',
        ));

        $fieldset->addField('quantity', 'text', array(
            'label' => Mage::helper('product')->__('Quantity'),
            'required' => true,
            'name' => 'quantity',
        ));

        $fieldset->addField('url', 'text', array(
            'label' => Mage::helper('product')->__('Url'),
            'required' => true,
            'name' => 'url',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getProductData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getProductData());
            Mage::getSingleton('adminhtml/session')->setProductData(null);
        } elseif ( Mage::registry('product_edit') ) {
            $form->setValues(Mage::registry('product_edit')->getData());
        }
        return parent::_prepareForm();


    }

}





    