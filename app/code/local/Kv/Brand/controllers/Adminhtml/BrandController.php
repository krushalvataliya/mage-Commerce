<?php

class Kv_Brand_Adminhtml_BrandController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Brand'))
             // ->_title($this->__('Manage Brands'))
             ->_title($this->__('Manage Brands'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('brand/adminhtml_brand'));
        $this->renderLayout();
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('brand/brand')
            ->_addBreadcrumb(Mage::helper('brand')->__('brand Manager'), Mage::helper('brand')->__('brand Manager'))
            ->_addBreadcrumb(Mage::helper('brand')->__('Manage brand'), Mage::helper('brand')->__('Manage brand'))
        ;
        return $this;
    }
    

    public function editAction()
    {
        $this->_title($this->__('brand'))
             ->_title($this->__('brands'))
             ->_title($this->__('Edit brands'));

        $id = $this->getRequest()->getParam('brand_id');
        $model = Mage::getModel('brand/brand');
        if ($id) {
            $model->load($id);
            // print_r($model);die;
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('brand')->__('This page no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        // echo "<pre>";print_r($model->load($id));die;
        $this->_title($model->getId() ? $model->getTitle() : $this->__('New brand'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

        if (!empty($data)) 
        {
            $model->setData($data);
        }

        Mage::register('brand_edit',$model);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('brand')->__('Edit brand')
                    : Mage::helper('brand')->__('New brand'),
                $id ? Mage::helper('brand')->__('Edit brand')
                    : Mage::helper('brand')->__('New brand'));

        $this->_addContent($this->getLayout()->createBlock(' brand/adminhtml_brand_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('brand/adminhtml_brand_edit_tabs'));

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('brand/brand');
            $data = $this->getRequest()->getPost();
            if (!$this->getRequest()->getParam('id'))
            {
                $model->setData($data)->setId($this->getRequest()->getParam('brand_id'));
            }

            $model->setData($data)->setId($this->getRequest()->getParam('id'));
            if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL)
            {
                $model->created_at = date('Y-m-d : H:i:s');
            } 
            else {
                $model->updated_at = now();
            }
            $model->save();
            if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != '')) 
            {
                try {
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png', 'webp'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    
                    $path = Mage::getBaseDir('media') . DS . 'brand' . DS;
                    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    if ($uploader->save($path, $model->getId().'.'.$extension)) {
                        $model->image = $model->getId().".".$extension;
                        $model->save();
                        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('brand')->__('Image was successfully uploaded'));
                    }
                    
                    // $imageName = $uploader->getUploadedFileName();

                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
            }
             
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('brand')->__('brand was successfully saved'));
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
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('brand_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('brand')->__('Unable to find brand to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('brand_id') > 0 ) {
            try {
                $model = Mage::getModel('brand/brand');
                 
                $model->setId($this->getRequest()->getParam('brand_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('brand was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('brand_id')));
            }
        }
        $this->_redirect('*/*/');
    }
}
