<?php
class Ccc_Salesman_Adminhtml_SalesmanController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
    	$this->_title($this->__('Salesman'))
             // ->_title($this->__('Manage Salesmans'))
             ->_title($this->__('Manage Salesman'));
       	$this->loadLayout();
       	$this->_addContent($this->getLayout()->createBlock('salesman/adminhtml_Salesman'));
	   	$this->renderLayout();
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('salesman/salesman')
            ->_addBreadcrumb(Mage::helper('salesman')->__('Salesman Manager'), Mage::helper('salesman')->__('Salesman Manager'))
            ->_addBreadcrumb(Mage::helper('salesman')->__('Manage Salesman'), Mage::helper('salesman')->__('Manage Salesman'))
        ;
        return $this;
    }
    
    // public function priceAction()
    // {
    //     $this->_title($this->__('Salesman'))
    //          // ->_title($this->__('Manage Salesmans'))
    //          ->_title($this->__('Manage Salesman'));
    //     $this->loadLayout();
    //     $this->_addContent($this->getLayout()->createBlock('salesman/adminhtml_salesman_edit_tab_salesman_price'))
    //         ->_addLeft();
    //     $this->renderLayout();
    // }

    public function editAction()
    {
        $this->_title($this->__('Salesman'))
             ->_title($this->__('Salesman'))
             ->_title($this->__('Edit Salesman'));

        $id = $this->getRequest()->getParam('salesman_id');
        $model = Mage::getModel('salesman/salesman');
        $addressModel = Mage::getModel('salesman/salesman_address');

        if ($id) {
            $model->load($id);
            $addressModel->load($id,'salesman_id');
            if (! $model) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('salesman')->__('This page no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->_title($model->getId() ? $model->getTitle() : $this->__('New Salesman'));
        $this->_title($addressModel->getId() ? $addressModel->getTitle() : $this->__('New Salesman Address'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

        if (!empty($data)) 
        {
            $model->setData($data);
        }

        Mage::register('salesman_edit',$model);
        Mage::register('address_edit',$addressModel);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('salesman')->__('Edit Salesman')
                    : Mage::helper('salesman')->__('New Salesman'),
                $id ? Mage::helper('salesman')->__('Edit Salesman')
                    : Mage::helper('salesman')->__('New Salesman'));

        $this->_addContent($this->getLayout()->createBlock('salesman/adminhtml_salesman_edit'))
                ->_addLeft($this->getLayout()->createBlock('salesman/adminhtml_salesman_edit_tabs'));

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        try {

            $postData = $this->getRequest()->getPost();
            $model = Mage::getModel('salesman/salesman');
            $addressModel = Mage::getModel('salesman/salesman_address');
            $addressData = $this->getRequest()->getPost('address');
            $data = $this->getRequest()->getPost('salesman');
            $salesmanId = $this->getRequest()->getParam('id');
            if (!$salesmanId)
            {
                $salesmanId = $this->getRequest()->getParam('salesman_id');
            }

            $model->setData($data)->setId($salesmanId);
            if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL)
            {
                $model->setCreatedTime(now())->setUpdateTime(now());
            } 
            else {
                $model->setUpdateTime(now());
            }
            $model->save();
            if ($model->save()) {
                if ($salesmanId) {
                    $addressModel->load($salesmanId,'salesman_id');
                }

                $addressModel->setData(array_merge($addressModel->getData(),$addressData));
                $addressModel->salesman_id = $model->salesman_id;
                $addressModel->save();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('salesman')->__('Salesman was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
             
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('salesman_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Unable to find Salesman to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('salesman_id') > 0 ) {
            try {
                $model = Mage::getModel('salesman/salesman');
                 
                $model->setId($this->getRequest()->getParam('salesman_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('salesman was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('salesman_id')));
            }
        }
        $this->_redirect('*/*/');
    }
}