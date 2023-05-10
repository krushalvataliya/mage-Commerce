<?php

class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Addresses extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('salesman_form',array('legend'=>Mage::helper('salesman')->__('Salesman Addresses')));

        $fieldset->addField('address', 'text', array(
            'label' => Mage::helper('salesman')->__('Address'),
            'required' => true,
            'name' => 'address[address]',
        ));

        $fieldset->addField('city','text', array(
            'label' => Mage::helper('salesman')->__('City'),
            'required' => true,
            'name' => 'address[city]'
        ));

        $fieldset->addField('state', 'text', array(
            'label' => Mage::helper('salesman')->__('State'),
            'required' => true,
            'name' => 'address[state]',
        ));

        $fieldset->addField('country','text', array(
            'label' => Mage::helper('salesman')->__('Country'),
            'required' => true,
            'name' => 'address[country]'
        ));

        $fieldset->addField('zipcode','text', array(
            'label' => Mage::helper('salesman')->__('Zipcode'),
            'required' => true,
            'name' => 'address[zipcode]'
        ));

        if ( Mage::getSingleton('adminhtml/session')->getSalesmanData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSalesmanData());
            Mage::getSingleton('adminhtml/session')->setSalesmanData(null);
        } elseif ( Mage::registry('address_edit') ) {
            $form->setValues(Mage::registry('address_edit')->getData());
        }
        return parent::_prepareForm();

    }

}





    