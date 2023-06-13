<?php

class Kv_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('vendor_form',array('legend'=>Mage::helper('vendor')->__('Vendor Information')));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('vendor')->__('Name'),
            'required' => true,
            'name' => 'vendor[name]',
        ));

         $fieldset->addField('email', 'text', array(
            'label' => Mage::helper('vendor')->__('Email'),
            'required' => true,
            'name' => 'vendor[email]',
        ));

        $newFieldset = $form->addFieldset(
                'password_fieldset',
                array('legend'=>Mage::helper('customer')->__('Password Management'))
            );
            $field = $newFieldset->addField('password', 'text',
                array(
                    'label' => Mage::helper('customer')->__('Password'),
                    'class' => 'input-text required-entry validate-password min-pass-length-' . $minPasswordLength,
                    'name'  => 'vendor[password]',
                    'required' => true,
                    'note' => Mage::helper('adminhtml')
                        ->__('Password must be at least of %d characters.', $minPasswordLength),
                )
            );
            $field->setRenderer($this->getLayout()->createBlock('adminhtml/customer_edit_renderer_newpass'));

        $fieldset->addField('mobile','text', array(
            'label' => Mage::helper('vendor')->__('Mobile'),
            'required' => true,
            'name' => 'vendor[mobile]'
        ));

        //  $countryOptions = Mage::getModel('directory/country')->getResourceCollection()
        //     ->loadByStore()
        //     ->toOptionArray();
        // $fieldset->addField('country', 'select', array(
        //     'name' => 'address[country]',
        //     'label' => Mage::helper('vendor')->__('Country'),
        //     'required' => false,
        //     'values' => $countryOptions,
        //     'onchange' => 'getStates(this.value)'
        // ));

        // $stateOptions = array();
        // $fieldset->addField('state', 'select', array(
        //     'label'    => 'State',
        //     'name'     => 'address[state]',
        //     'values'   => $stateOptions,
        //     'required' => true
        // ));

        // $countryField = $form->getElement('country');
        // $registry = Mage::registry('address_edit')->getData();
        // $countryField->setValue($registry['country']);
        // $countryField->setAfterElementHtml('
        //     <script type="text/javascript">
        //         document.observe("dom:loaded", function() {
        //             getStates("' . $registry['country'] . '");
        //         });
        //         function getStates(countryId) {
        //             var url = \'' . $this->getUrl('vendor/adminhtml_vendor/state') . '\';
                    
        //             var stateElement = $("state");
        //             new Ajax.Request(url, {
        //                 method: "post",
        //                 parameters: {
        //                     country_id: countryId
        //                 },
        //                 onSuccess: function(response) {
        //                     var stateOptions = JSON.parse(response.responseText);
        //                     var optionsHtml = "";
        //                     stateOptions.forEach(function(option) {
        //                         optionsHtml += "<option value=\"" + option.value + "\"";
        //                         if (option.value == "' . $registry['state'] . '") {
        //                             optionsHtml += " selected";
        //                         }
        //                         optionsHtml += ">" + option.label + "</option>";
        //                     });
        //                     stateElement.update(optionsHtml);
        //                 },
        //                 onFailure: function() {
        //                     stateElement.update("");
        //                 }
        //             });
        //         }
        //     </script>
        // ');


        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('vendor')->__('Status'),
            'required' => false,
            'name' => 'vendor[status]',
            'options' => array(1=>'Active',2=>'Inactive'),
        ));


        if ( Mage::getSingleton('adminhtml/session')->getVendorData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getVendorData());
            Mage::getSingleton('adminhtml/session')->setVendorData(null);
        } elseif ( Mage::registry('vendor_edit') ) {
            $form->setValues(Mage::registry('vendor_edit')->getData());
        }
        return parent::_prepareForm();


    }

}





    