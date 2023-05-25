<?php

class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('salesman_form',array('legend'=>Mage::helper('salesman')->__('Salesman Information')));

        $fieldset->addField('first_name', 'text', array(
            'label' => Mage::helper('salesman')->__('First Name'),
            'required' => true,
            'name' => 'salesman[first_name]',
        ));

        $fieldset->addField('last_name','text', array(
            'label' => Mage::helper('salesman')->__('Last Name'),
            'required' => true,
            'name' => 'salesman[last_name]'
        ));

         $fieldset->addField('gender', 'radios', array(
            'label' => Mage::helper('salesman')->__('Gender'),
            'required' => false,
            'name' => 'salesman[gender]',
            'values' =>array(
                array('value'=>1,'label'=>'Male'),
                array('value'=>2,'label'=>'Female'),
            )
        ));

        $fieldset->addField('email', 'text', array(
            'label' => Mage::helper('salesman')->__('Email'),
            'required' => true,
            'name' => 'salesman[email]',
        ));

         $fieldset->addField('company', 'text', array(
            'label' => Mage::helper('salesman')->__('Company'),
            'required' => true,
            'name' => 'salesman[company]',
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





    