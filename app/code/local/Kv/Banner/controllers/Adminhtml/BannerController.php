<?php

class Kv_Banner_Adminhtml_BannerController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Banner'))
             ->_title($this->__('Manage Banners'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('banner/adminhtml_banner'));
        $this->renderLayout();
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('banner/banner')
            ->_addBreadcrumb(Mage::helper('banner')->__('banner Manager'), Mage::helper('banner')->__('banner Manager'))
            ->_addBreadcrumb(Mage::helper('banner')->__('Manage banner'), Mage::helper('banner')->__('Manage banner'))
        ;
        return $this;
    }
    

    public function editAction()
    {
        $this->_title($this->__('banner'))
             ->_title($this->__('banners'))
             ->_title($this->__('Edit banners'));

        $id = $this->getRequest()->getParam('banner_id');
        $model = Mage::getModel('banner/banner');
        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('banner')->__('This page no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        // echo "<pre>";print_r($model->load($id));die;
        $this->_title($model->getId() ? $model->getTitle() : $this->__('New banner'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

        if (!empty($data)) 
        {
            $model->setData($data);
        }

        Mage::register('banner_edit',$model);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('banner')->__('Edit banner')
                    : Mage::helper('banner')->__('New banner'),
                $id ? Mage::helper('banner')->__('Edit banner')
                    : Mage::helper('banner')->__('New banner'));

        $this->_addContent($this->getLayout()->createBlock(' banner/adminhtml_banner_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('banner/adminhtml_banner_edit_tabs'));

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('banner/banner');
            $data = $this->getRequest()->getPost();
            if (!$this->getRequest()->getParam('id'))
            {
                $model->setData($data)->setId($this->getRequest()->getParam('banner_id'));
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

              if(isset($_FILES['image']['name'])) {
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg','jpeg','png')); // or pdf or anything
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $path = Mage::getBaseDir('media') . DS . 'banner/original' . DS;
                    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    if (!$uploader->save($path, $model->getId().'.'.$ext)) {
                        throw new Exception("Image Not saved", 1);
                    }
                }
                    $bannerGroupModel = Mage::getModel('banner/group')->load($model->group_id);
                    $width = $bannerGroupModel->width;
                    $height = $bannerGroupModel->height;

                    $resizedPath = Mage::getBaseDir('media') . DS . 'banner' . DS . 'resized';
                    $image = new Varien_Image($path . DS . $model->getId().'.'.$ext);
                    // $image->constrainOnly(true);
                    $image->keepAspectRatio(true);
                    $image->resize($width, $height);
                    $image->save($resizedPath . DS . $model->getId().'.'.$ext);
                    $model->image = 'banner/resized/'.$model->getId().'.'.$ext;
                    $model->save();

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('banner')->__('banner was successfully saved'));
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
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('banner_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('banner')->__('Unable to find banner to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('banner_id') > 0 ) {
            try {
                $model = Mage::getModel('banner/banner');
                 
                $model->setId($this->getRequest()->getParam('banner_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('banner was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('banner_id')));
            }
        }
        $this->_redirect('*/*/');
    }
}
