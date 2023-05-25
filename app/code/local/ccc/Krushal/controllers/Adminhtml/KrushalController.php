<?php 

class Ccc_Krushal_Adminhtml_KrushalController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction(){
		$this->loadLayout();
		$this->_setActiveMenu('krushal');
		$this->_title('Krushal Grid');
		$this->_addContent($this->getLayout()->createBlock('krushal/adminhtml_krushal'));
		$this->renderLayout();
	}

	protected function _initKrushal()
    {
        $this->_title($this->__('Krushal'))
            ->_title($this->__('Manage Krushal'));

        $krushalId = (int) $this->getRequest()->getParam('id');
        $krushal   = Mage::getModel('krushal/krushal')
            ->setStoreId($this->getRequest()->getParam('store', 0))
            ->load($krushalId);

        if (!$krushalId) {
            if ($setId = (int) $this->getRequest()->getParam('set')) {
                $krushal->setAttributeSetId($setId);
            }
        }

        Mage::register('current_krushal', $krushal);
        Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));
        return $krushal;
    }

	public function newAction(){
		$this->_forward('edit');
	}

	public function editAction(){ 
		$krushalId = (int) $this->getRequest()->getParam('id');
        $krushal   = $this->_initKrushal();
        
        if ($krushalId && !$krushal->getId()) {
            $this->_getSession()->addError(Mage::helper('krushal')->__('This krushal no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }

        $this->_title($krushal->getName());

        $this->loadLayout();

        $this->_setActiveMenu('krushal/krushal');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->renderLayout();
	}

	public function saveAction()
    {
        try {
            $setId = (int) $this->getRequest()->getParam('set');
            $krushalData = $this->getRequest()->getPost('account');            
            $krushal = Mage::getSingleton('krushal/krushal');
            $krushal->setAttributeSetId($setId);

            if ($krushalId = $this->getRequest()->getParam('id')) {
                if (!$krushal->load($krushalId)) {
                    throw new Exception("No Row Found");
                }
                Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
            }
            
            $krushal->addData($krushalData);

            $krushal->save();

            Mage::getSingleton('core/session')->addSuccess("krushal data added.");
            $this->_redirect('*/*/');

        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction()
    {
        try {

            $krushalModel = Mage::getModel('krushal/krushal');

            if (!($krushalId = (int) $this->getRequest()->getParam('id')))
                throw new Exception('Id not found');

            if (!$krushalModel->load($krushalId)) {
                throw new Exception('krushal does not exist');
            }

            if (!$krushalModel->delete()) {
                throw new Exception('Error in delete record', 1);
            }

            Mage::getSingleton('core/session')->addSuccess($this->__('The krushal has been deleted.'));

        } catch (Exception $e) {
            Mage::logException($e);
            $Mage::getSingleton('core/session')->addError($e->getMessage());
        }
        
        $this->_redirect('*/*/');
    }
}