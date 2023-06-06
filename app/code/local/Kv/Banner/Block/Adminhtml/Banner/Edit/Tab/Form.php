<?php

class Kv_banner_Block_Adminhtml_banner_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('banner_form',array('legend'=>Mage::helper('banner')->__('banner information')));

        $fieldset->addField('group_id', 'select', array(
        'name' => 'group_id',
        'label' => Mage::helper('banner')->__('Group'),
        'title' => Mage::helper('banner')->__('Group'),
        'values' => Mage::getModel('banner/group')->getGroupArray(),
        'required' => false,
        ));

        $fieldset->addField('image', 'image', array(
            'name' => 'image',
            'label' => Mage::helper('banner')->__('Image'),
            'title' => Mage::helper('banner')->__('Image'),
            'required' => true,
        ));

        $fieldset->addField('status', 'select', array(
            'name' => 'status',
            'label' => Mage::helper('banner')->__('Status'),
            'title' => Mage::helper('banner')->__('Status'),
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('banner')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('banner')->__('Disabled'),
                ),
            ),
            'required' => true,
        ));

        $fieldset->addField('position', 'text', array(
            'name' => 'position',
            'label' => Mage::helper('banner')->__('Position'),
            'title' => Mage::helper('banner')->__('Position'),
            'required' => true,
        ));


        if ( Mage::getSingleton('adminhtml/session')->getbannerData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getbannerData());
            Mage::getSingleton('adminhtml/session')->setbannerData(null);
        } elseif ( Mage::registry('banner_edit') ) {
            $form->setValues(Mage::registry('banner_edit')->getData());
        }
        return parent::_prepareForm();


    }

}





    