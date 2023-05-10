<?php
class Ccc_salesman_Adminhtml_salesmanController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
    	$this->_title($this->__('salesman'))
             // ->_title($this->__('Manage salesmans'))
             ->_title($this->__('Manage salesmans'));
       	$this->loadLayout();
        $this->_setActiveMenu('salesman');
       	$this->_addContent($this->getLayout()->createBlock('salesman/adminhtml_salesman'));
	   	$this->renderLayout();
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('salesman/salesman')
            ->_addBreadcrumb(Mage::helper('salesman')->__('salesman Manager'), Mage::helper('salesman')->__('salesman Manager'))
            ->_addBreadcrumb(Mage::helper('salesman')->__('Manage salesman'), Mage::helper('salesman')->__('Manage salesman'))
        ;
        return $this;
    }
    

    public function editAction()
    {
        $this->_title($this->__('salesman'))
             ->_title($this->__('salesmans'))
             ->_title($this->__('Edit salesmans'));

        // print_r($this->_addContent($this->getLayout()->createBlock('Ccc_salesman_Block_Adminhtml_salesman_Edit')));
        $id = $this->getRequest()->getParam('salesman_id');
        $model = Mage::getModel('salesman/salesman');
        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('salesman')->__('This page no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        // echo "<pre>";print_r($model->load($id));die;
        $this->_title($model->getId() ? $model->getTitle() : $this->__('New salesman'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

        if (!empty($data)) 
        {
            $model->setData($data);
        }

        Mage::register('salesman_edit',$model);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('salesman')->__('Edit salesman')
                    : Mage::helper('salesman')->__('New salesman'),
                $id ? Mage::helper('salesman')->__('Edit salesman')
                    : Mage::helper('salesman')->__('New salesman'));

        $this->_addContent($this->getLayout()->createBlock(' salesman/adminhtml_salesman_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('salesman/adminhtml_salesman_edit_tabs'));

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('salesman/salesman');
            $data = $this->getRequest()->getPost();
            if (!$this->getRequest()->getParam('id'))
            {
                $model->setData($data)->setId($this->getRequest()->getParam('salesman_id'));
            }

            $model->setData($data)->setId($this->getRequest()->getParam('id'));
            if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL)
            {
                $model->setCreatedTime(now())->setUpdateTime(now());
            } 
            else {
                $model->setUpdateTime(now());
            }
             
            $model->save();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('salesman')->__('salesman was successfully saved'));
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

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Unable to find salesman to save'));
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