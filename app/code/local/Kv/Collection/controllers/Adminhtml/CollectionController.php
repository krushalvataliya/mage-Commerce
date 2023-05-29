<?php

class Kv_Collection_Adminhtml_CollectionController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Collection'))
             // ->_title($this->__('Manage Collections'))
             ->_title($this->__('Manage Collections'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('collection/adminhtml_collection'));
        $this->renderLayout();
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('collection/collection')
            ->_addBreadcrumb(Mage::helper('collection')->__('collection Manager'), Mage::helper('collection')->__('collection Manager'))
            ->_addBreadcrumb(Mage::helper('collection')->__('Manage collection'), Mage::helper('collection')->__('Manage collection'))
        ;
        return $this;
    }
    

    public function editAction()
    {
        $this->_title($this->__('collection'))
             ->_title($this->__('collections'))
             ->_title($this->__('Edit collections'));

        $id = $this->getRequest()->getParam('collection_id');
        $model = Mage::getModel('collection/collection');
        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('collection')->__('This page no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        // echo "<pre>";print_r($model->load($id));die;
        $this->_title($model->getId() ? $model->getTitle() : $this->__('New collection'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

        if (!empty($data)) 
        {
            $model->setData($data);
        }

        Mage::register('collection_edit',$model);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('collection')->__('Edit collection')
                    : Mage::helper('collection')->__('New collection'),
                $id ? Mage::helper('collection')->__('Edit collection')
                    : Mage::helper('collection')->__('New collection'));

        $this->_addContent($this->getLayout()->createBlock(' collection/adminhtml_collection_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('collection/adminhtml_collection_edit_tabs'));

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('collection/collection');
            $data = $this->getRequest()->getPost();
            if (!$this->getRequest()->getParam('id'))
            {
                $model->setData($data)->setId($this->getRequest()->getParam('collection_id'));
            }

            $model->setData($data)->setId($this->getRequest()->getParam('id'));
            if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL)
            {
                $model->created_at = date('Y-m-d : H:i:s');
            } 
            else {
                $model->setUpdateTime(now());
            }
             
            $model->save();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('collection')->__('collection was successfully saved'));
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
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('collection_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('collection')->__('Unable to find collection to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('collection_id') > 0 ) {
            try {
                $model = Mage::getModel('collection/collection');
                 
                $model->setId($this->getRequest()->getParam('collection_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('collection was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('collection_id')));
            }
        }
        $this->_redirect('*/*/');
    }
}
