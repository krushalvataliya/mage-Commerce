<?php
 
class Ccc_Product_Adminhtml_ProductController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
    	$this->_title($this->__('product'))
             // ->_title($this->__('Manage products'))
             ->_title($this->__('Manage products'));
       	$this->loadLayout();
       	$this->_addContent($this->getLayout()->createBlock('product/adminhtml_product'));
	   	$this->renderLayout();
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('product/product')
            ->_addBreadcrumb(Mage::helper('product')->__('product Manager'), Mage::helper('product')->__('product Manager'))
            ->_addBreadcrumb(Mage::helper('product')->__('Manage product'), Mage::helper('product')->__('Manage product'))
        ;
        return $this;
    }
    

    public function editAction()
    {
        $this->_title($this->__('product'))
             ->_title($this->__('products'))
             ->_title($this->__('Edit products'));

        // print_r($this->_addContent($this->getLayout()->createBlock('Ccc_product_Block_Adminhtml_product_Edit')));
        $id = $this->getRequest()->getParam('product_id');
        $model = Mage::getModel('product/product');
        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('product')->__('This page no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        // echo "<pre>";print_r($model->load($id));die;
        $this->_title($model->getId() ? $model->getTitle() : $this->__('New product'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

        if (!empty($data)) 
        {
            $model->setData($data);
        }

        Mage::register('product_edit',$model);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('product')->__('Edit product')
                    : Mage::helper('product')->__('New product'),
                $id ? Mage::helper('product')->__('Edit product')
                    : Mage::helper('product')->__('New product'));

        $this->_addContent($this->getLayout()->createBlock(' product/adminhtml_product_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('product/adminhtml_product_edit_tabs'));

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('product/product');
            $data = $this->getRequest()->getPost();
            if (!$this->getRequest()->getParam('id'))
            {
                $model->setData($data)->setId($this->getRequest()->getParam('product_id'));
            }

            $model->setData($data)->setId($this->getRequest()->getParam('id'));
            if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL)
            {
                $model->setCreatedTime(now())->setUpdateTime(now());
            } 
            else {
                $model->setUpdateTime(now());
            }
             Mage::dispatchEvent('cms_page_prepare_save', array('page' => $model, 'request' => $this->getRequest()));

            $model->save();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('product')->__('product was successfully saved'));
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
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('product_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product')->__('Unable to find product to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('product_id') > 0 ) {
            try {
                $model = Mage::getModel('product/product');
                 
                $model->setId($this->getRequest()->getParam('product_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('product was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('product_id')));
            }
        }
        $this->_redirect('*/*/');
    }
}