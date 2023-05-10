<?php

class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('salesman_form',array('legend'=>Mage::helper('salesman')->__('salesman information')));

        $fieldset->addField('first_name', 'text', array(
            'label' => Mage::helper('salesman')->__('first_name'),
            'required' => true,
            'name' => 'first_name',
        ));

        $fieldset->addField('last_name','text', array(
            'label' => Mage::helper('salesman')->__('last_name'),
            'required' => true,
            'name' => 'last_name'
        ));

        $fieldset->addField('email','text', array(
            'label' => Mage::helper('salesman')->__('email'),
            'required' => true,
            'name' => 'email'
        ));

        $fieldset->addField('gender', 'text', array(
            'label' => Mage::helper('salesman')->__('gender'),
            'required' => true,
            'name' => 'gender',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getSalesmanData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSalesmanData());
            Mage::getSingleton('adminhtml/session')->setSalesmanData(null);
        } elseif ( Mage::registry('salesman_edit') ) {
            $form->setValues(Mage::registry('salesman_edit')->getData());
        }
        return parent::_prepareForm();


    }

}





    