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

    protected function _mail($processedTemplate,$email)
    {
         $config = array(
                'ssl' => 'tls',
                'port' => 587,
                'auth' => 'login',
                'username' => 'krushalvataliya.cybercom@gmail.com',
                'password' => 'ziozvpmvwxgattmv',
            );

        $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);

        $mail = new Zend_Mail('UTF-8');
        $mail->setBodyHtml($processedTemplate);
        $mail->setfrom($email, 'krushal'); // Replace with your Gmail email address and name
        $mail->addTo($email, 'Vendor');
        $mail->setSubject('Welcome Vendor');
        $mail->setBodyText('Hello vendor, hope you have a good day!');
        $mail->send($transport);
        return ;
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
            $this->_mail($processedTemplate, $email);
           
        } catch (Exception $e) {
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }

    }

    public function sendVerificationEmail($verificationLink)
    {
       try {
            $email = $this->getEmail();
            // $email = $this->getEmail();
            $vars = array(
                'vendor' =>$this,
                'key' => 'Hello vendor, hope you have a good day!',
            );
            $emailTemplate = Mage::getModel('core/email_template')->loadDefault('vendor_email_varification');

            $emailTemplate->setTemplateVars($vars);
            $processedTemplate = $emailTemplate->getProcessedTemplate($vars);
            $this->_mail($processedTemplate, $email);
            
        } catch (Exception $e) {
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

    public function generateVerificationKey()
    {
      // Generate a random verification key
      $keyLength = 16; // Length of the verification key
      $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Characters to use for the key
      $verificationKey = '';

      for ($i = 0; $i < $keyLength; $i++) {
        $verificationKey .= $characters[rand(0, strlen($characters) - 1)];
      }

      return $verificationKey;
    }


}
