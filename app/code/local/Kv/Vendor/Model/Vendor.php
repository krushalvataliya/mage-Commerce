<?php

class Kv_Vendor_Model_Vendor extends Mage_Core_Model_Abstract
{
    function __construct()
    {
        $this->_init('vendor/vendor');
    }

    public function reset()
    {
        $this->setData(array());
        $this->setOrigData();
        $this->_attributes = null;
        return $this;
    }

    public function sendMail($vendor)
    {
        try {

            $email = $vendor->getEmail();
            $vars = array(
                'customer_name' => 'Hello vendor, hope you have a good day!',
            );
            $emailTemplate = Mage::getModel('core/email_template')->loadDefault('vendor_account_details');

            $processedTemplate = $emailTemplate->getProcessedTemplate($vars);
            $config = array(
                'ssl' => 'tls',
                'port' => 587,
                'auth' => 'login',
                'username' => 'krushalvataliya.cybercom@gmail.com', // Replace with your Gmail email address
                'password' => 'ziozvpmvwxgattmv', // Replace with your Gmail password or app password
            );

            $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);

            $mail = new Zend_Mail('UTF-8');
            $mail->setBodyHtml($processedTemplate);
            $mail->setfrom('krushalvataliya.cybercom@gmail.com', 'krushal'); // Replace with your Gmail email address and name
            $mail->addTo('krushalvataliya24@gmail.com', 'Vendor');
            $mail->setSubject('Welcome Vendor');
            $mail->setBodyText('Hello vendor, hope you have a good day!');
        } catch (Exception $e) {
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }

    }
}
