<?php

class Kv_collection_Block_Adminhtml_collection_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('collection_form',array('legend'=>Mage::helper('collection')->__('collection information')));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('collection')->__('Name'),
            'required' => true,
            'name' => 'name',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('collection')->__('Status'),
            'required' => true,
            'name' => 'status',
            // 'values' =>array(
            //     array('value'=>1,'label'=>'Active'),
            //     array('value'=>2,'label'=>'Inactive'),
            // )
            'options'=> array(
                1 => "Active",
                2 => "Inactive",
            ),

        ));

        if ( Mage::getSingleton('adminhtml/session')->getcollectionData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getcollectionData());
            Mage::getSingleton('adminhtml/session')->setcollectionData(null);
        } elseif ( Mage::registry('collection_edit') ) {
            $form->setValues(Mage::registry('collection_edit')->getData());
        }
        return parent::_prepareForm();


    }

}





    