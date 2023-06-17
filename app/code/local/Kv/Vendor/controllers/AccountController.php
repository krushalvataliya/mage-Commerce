<?php
class Kv_Vendor_AccountController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();  
    }

    public function confirmationAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

	public function confirmAction()
    {   
        try {

            $id = $this->getRequest()->getParam('id');
            $token = $this->getRequest()->getParam('key');
            if(!$id || $token == null)
            {
                throw new Exception("invalid Request.", 1);
            }

            $model = Mage::getModel('vendor/vendor')->load($id);
            if($model->getIsEmailVarified() == 1)
            {
                Mage::getSingleton('core/session')->addNotice('Your email address is already varified.');
            }
            else
            {
                if($token == $model->getToken())
                {
                    $model->is_email_varified = 1;
                    $model->token = '';
                    $model->save();
                Mage::getSingleton('core/session')->addSuccess('Your email is varified succsessfully');
                }
            }
        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
        }
            $this->_redirect('vendor/login/');


    }

}
        