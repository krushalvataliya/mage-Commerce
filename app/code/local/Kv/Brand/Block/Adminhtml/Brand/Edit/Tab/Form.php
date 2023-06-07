<?php

class Kv_Brand_Block_Adminhtml_brand_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('brand_form',array('legend'=>Mage::helper('brand')->__('brand information')));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('brand')->__('Name'),
            'required' => true,
            'name' => 'name',
        ));

         $fieldset->addField('image', 'file', array(
            'label' => Mage::helper('brand')->__('Image'),
            'required' => false,
            'name' => 'image',
        ));

        $fieldset->addField('banner', 'file', array(
            'label' => Mage::helper('brand')->__('Banner'),
            'required' => false,
            'name' => 'banner',
        ));

        $fieldset->addField('url_key', 'text', array(
            'label' => Mage::helper('brand')->__('Url Key'),
            'required' => true,
            'name' => 'url_key',
        ));

        $fieldset->addField('description', 'text', array(
            'label' => Mage::helper('brand')->__('Description'),
            'required' => true,
            'name' => 'description',
        ));



        

        if ( Mage::getSingleton('adminhtml/session')->getbrandData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getbrandData());
            Mage::getSingleton('adminhtml/session')->setbrandData(null);
        } elseif ( Mage::registry('brand_edit') ) {
            $form->setValues(Mage::registry('brand_edit')->getData());
        }
        return parent::_prepareForm();


    }

}





    