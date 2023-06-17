<?php

class Kv_Vendor_Helper_Vendor extends Mage_Core_Helper_Abstract
{
	public function __construct()
	{

	}

	public function getEmailConfirmationUrl($email)
	{
		$this->redirect($this->getUrl('customer/account/confirmation',['mail'=>$mail]));
	}

}
