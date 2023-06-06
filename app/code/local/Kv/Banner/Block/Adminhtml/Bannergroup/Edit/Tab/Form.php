<?php

class Kv_banner_Block_Adminhtml_Bannergroup_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('banner_form',array('legend'=>Mage::helper('banner')->__('banner information')));

         $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => Mage::helper('group')->__('Name'),
            'title'     => Mage::helper('group')->__('Name'),
            'required'  => true,
        ));

        $fieldset->addField('group_key', 'text', array(
            'name'      => 'group_key',
            'label'     => Mage::helper('group')->__('Group Key'),
            'title'     => Mage::helper('group')->__('Group Key'),
            'required'  => true,
        ));

        $fieldset->addField('height', 'text', array(
            'name'      => 'height',
            'label'     => Mage::helper('group')->__('Height'),
            'title'     => Mage::helper('group')->__('Height'),
            'required'  => true,
        ));

        $fieldset->addField('width', 'text', array(
            'name'      => 'width',
            'label'     => Mage::helper('group')->__('Width'),
            'title'     => Mage::helper('group')->__('Width'),
            'required'  => true,
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





    