<?php

class Kv_Banner_Adminhtml_BannergroupController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Banner'))
             ->_title($this->__('Manage Banners'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('banner/adminhtml_bannergroup'));
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
        $model = Mage::getModel('banner/group');
        Mage::register('banner',$model);
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

        $this->_addContent($this->getLayout()->createBlock(' banner/adminhtml_bannergroup_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('banner/adminhtml_bannergroup_edit_tabs'));

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        echo "<pre>";

            $data = $this->getRequest()->getPost();

        print_r($data);
        $position = $data['position'];
        $status = $data['status'];
        $remove = $data['remove'];
        print_r($position);

        foreach ($position as $key => $value) {
            $bannerModel = Mage::getModel('banner/banner');
            $bannerModel->banner_id = $key; 
            $bannerModel->position = $value;
            if(!$status[$key])
            {
                $status[$key] = 2;
            }
            $bannerModel->status = $status[$key];
            $bannerModel->save();
        }
        foreach ($remove as $key => $value) {
            $bannerModel = Mage::getModel('banner/banner')->load($key);
            $bannerModel->delete();
        }
        try {
            $model = Mage::getModel('banner/group');
            if (!$this->getRequest()->getParam('banner_id'))
            {
                $model->setData($data)->setId($this->getRequest()->getParam('banner_id'));
            }

            $model->setData($data)->setId($this->getRequest()->getParam('banner_id'));
             
            $model->save();

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('banner')->__('banner was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
             
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('banner_id' => $model->getId()));
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
                $model = Mage::getModel('banner/group');
                 
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

    // public function uploadAction()
    // {
    //         echo "<pre>";
    //         // print_r($_FILES['file']);
    //         // print_r($_FILES['file']['tmp_name']);

    //         $uploader = new Mage_Core_Model_File_Uploader('file[]');
    //         // print_r($uploader);die;
    //             $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
    //             $uploader->setAllowRenameFiles(false);
    //             $uploader->setFilesDispersion(false);

    //             $mediaPath = Mage::getSingleton('banner/group')->getBaseMediaPath();
    //             $uploader->save($mediaPath);

    //             $uploadedFiles = $uploader->getUploadedFiles();
    //             var_dump($uploadedFiles);
    //             die;
    //     try {
    //             foreach ($uploadedFiles as $uploadedFile) {
    //                 $fileName = $uploadedFile['file'];
    //                 // Perform further processing or save the file information in the database
    //             }


    //             $uploader = new Mage_Core_Model_File_Uploader('image');
    //             print_r($uploader);die;
    //             $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
    //             $uploader->addValidateCallback('catalog_product_image',
    //                 Mage::helper('catalog/image'), 'validateUploadFile');
    //             $uploader->setAllowRenameFiles(true);
    //             $uploader->setFilesDispersion(true);
    //             // $uploader->addValidateCallback(
    //             //     Mage_Core_Model_File_Validator_Image::NAME,
    //             //     Mage::getModel('core/file_validator_image'),
    //             //     'validate'
    //             // );
    //             // $result = $uploader->save(
    //             //     Mage::getSingleton('catalog/product_media_config')->getBaseTmpMediaPath()
    //             // );

    //             $result = $uploader->save(
    //                 Mage::getSingleton('banner/group')->getBaseMediaPath()
    //             );

    //         print_r($result);
    //         die;

    //         // Mage::dispatchEvent('catalog_product_gallery_upload_image_after', array(
    //         //     'result' => $result,
    //         //     'action' => $this
    //         // ));

    //         /**
    //          * Workaround for prototype 1.7 methods "isJSON", "evalJSON" on Windows OS
    //          */
    //         $result['tmp_name'] = str_replace(DS, "/", $result['tmp_name']);
    //         $result['path'] = str_replace(DS, "/", $result['path']);

    //         $result['url'] = Mage::getSingleton('catalog/product_media_config')->getTmpMediaUrl($result['file']);
    //         $result['file'] = $result['file'] . '.tmp';
    //         $result['cookie'] = array(
    //             'name'     => session_name(),
    //             'value'    => $this->_getSession()->getSessionId(),
    //             'lifetime' => $this->_getSession()->getCookieLifetime(),
    //             'path'     => $this->_getSession()->getCookiePath(),
    //             'domain'   => $this->_getSession()->getCookieDomain()
    //         );
    //         Mage::log($result,null,'uploadimg.log');
    //     } catch (Exception $e) {
    //         $result = array(
    //             'error' => $e->getMessage(),
    //             'errorcode' => $e->getCode());
    //     }

    //     $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    // }

    public function uploadAction()
    {
        try{
            $id = $this->getRequest()->getParam('group_id');
            $bannerGroupModel = Mage::getModel('banner/group')->load($id);
            $width = $bannerGroupModel->width;
            $height = $bannerGroupModel->height;
            $images = $_FILES['file'];
            foreach ($_FILES['file']['tmp_name'] as $index => $tmpName) {
                $uploader = new Mage_Core_Model_File_Uploader('file[' . $index . ']');
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(false);

                $uploadDir = Mage::getBaseDir('media') . DS . 'banner' . DS . 'original';
                $uploadResizedDir = Mage::getBaseDir('media') . DS . 'banner' . DS . 'resized';
                $uploader->save($uploadDir, $images['name'][$index]);

                $uploadedFilePath = $uploadDir . DS . $uploader->getUploadedFileName();
                $resizedFilePath = $uploadResizedDir . DS . $uploader->getUploadedFileName();

                $image = new Varien_Image($uploadedFilePath);
                // $image->constrainOnly(true);
                $image->keepAspectRatio(true);
                $image->resize($width, $height);
                $image->save($resizedFilePath);
                $model = Mage::getModel('banner/banner');
                $model->setImage('banner'.DS.'resized'.DS.$uploader->getUploadedFileName());
                $model->group_id = $id;
                $model->save();
                // $model->image = 'banner/resized/'.$model->getId().'.'.$ext;
                // $model->save();
            }

            } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('banner_id')));
        }
        $this->_redirect('*/*/edit',['banner_id'=> $id]);
    }
}
