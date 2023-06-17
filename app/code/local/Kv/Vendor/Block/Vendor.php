<?php
class Kv_Vendor_Block_Vendor extends Mage_Core_Block_Template
{
    function __construct()
    {

    }

    public function getLoginUrl()
    {
        return $this->getUrl('*/*/login');
    }

    public function getCreateAccountUrl()
    {
        return $this->getUrl('*/register');
    }
    public function getRegisterUrl()
    {
        return $this->getUrl('*/register/register');
    }

}
