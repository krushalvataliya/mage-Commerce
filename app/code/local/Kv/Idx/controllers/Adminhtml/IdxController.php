<?php
class Kv_Idx_Adminhtml_IdxController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Idx'))
             // ->_title($this->__('Manage Idxs'))
             ->_title($this->__('Manage Idxs'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('idx/adminhtml_idx'));
        $this->renderLayout();
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('idx/idx')
            ->_addBreadcrumb(Mage::helper('idx')->__('idx Manager'), Mage::helper('idx')->__('idx Manager'))
            ->_addBreadcrumb(Mage::helper('idx')->__('Manage idx'), Mage::helper('idx')->__('Manage idx'))
        ;
        return $this;
    }
    

    public function editAction()
    {
        $this->_title($this->__('idx'))
             ->_title($this->__('idxs'))
             ->_title($this->__('Edit idxs'));

        $id = $this->getRequest()->getParam('idx_id');
        $model = Mage::getModel('idx/idx');
        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('idx')->__('This page no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        // echo "<pre>";print_r($model->load($id));die;
        $this->_title($model->getId() ? $model->getTitle() : $this->__('New idx'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

        if (!empty($data)) 
        {
            $model->setData($data);
        }

        Mage::register('idx_edit',$model);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('idx')->__('Edit idx')
                    : Mage::helper('idx')->__('New idx'),
                $id ? Mage::helper('idx')->__('Edit idx')
                    : Mage::helper('idx')->__('New idx'));

        $this->_addContent($this->getLayout()->createBlock(' idx/adminhtml_idx_edit'))
                ->_addLeft($this->getLayout()
                ->createBlock('idx/adminhtml_idx_edit_tabs'));

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('idx/idx');
            $data = $this->getRequest()->getPost();
            if (!$this->getRequest()->getParam('id'))
            {
                $model->setData($data)->setId($this->getRequest()->getParam('idx_id'));
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
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('idx')->__('idx was successfully saved'));
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
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('idx_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('idx')->__('Unable to find idx to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('idx_id') > 0 ) {
            try {
                $model = Mage::getModel('idx/idx');
                 
                $model->setId($this->getRequest()->getParam('idx_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('idx was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('idx_id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function productAction()
    {
        echo "string";
    }

    public function collectionAction()
    {
        echo "string";
    }

    public function brandAction()
    {
        try {
            $idx = Mage::getModel('idx/idx');       
            $idxCollection = $idx->getCollection();
            $idxCollectionArray = $idx->getCollection()->getData();
            $idxBrandId = array_column($idxCollectionArray,'brand_id');
            $idxBrandNames = array_column($idxCollectionArray,'brand');
            $idxBrandNames = array_combine($idxBrandId,$idxBrandNames);

            $brand = Mage::getModel('brand/brand');       
            $brandCollection = $brand->getCollection();
            $brandCollectionArray = $brand->getCollection()->getData();
            $brandBrandId = array_column($brandCollectionArray,'brand_id');
            $brandNames = array_column($brandCollectionArray,'name');
            $brandNames = array_combine($brandBrandId,$brandNames);


        
            // echo "<pre>";

            // print_r($idxCollectionArray);
            print_r($idxBrandNames);
            print_r($brandNames);

            print_r($a = array_diff($brandNames, $idxBrandNames));
            // print_r(array_diff_key($brandNames,$a));
            // die();

            $newBrands = $idx->updateBrandTable(array_unique($idxBrandNames));

            // print_r($newBrands);
            foreach ($idxCollection as $idx) {
                $idxBrandName = $idx->getData('brand');
                $brandId = array_search($idxBrandName,$newBrands);
                $resource = Mage::getSingleton('core/resource');
                $connection = $resource->getConnection('core_write');
                $tableName = $resource->getTableName('import_product_idx');
                $condition = '`idx_id` = '.$idx->idx_id;
                $query = "UPDATE `{$tableName}` SET `brand_id` = {$brandId} WHERE {$condition}";
                $connection->query($query); 
                echo 111;die;
            }
            Mage::getSingleton('adminhtml/session')->addSuccess('Brand is fine now');
        } catch (Exception $e) {
            Mage::logException($e);
        }
            $this->_redirect('*/*/index');
    }

    function getOptionIdByValue($value, $options)
    {
        foreach ($options as $option) {
            if ($option['label'] == $value) {
                return $option['value'];
            }
        }
        return null;
    }

    function getMissingBrandOptions($existingOptions, $rows)
    {
        $existingValues = array_column($rows, 'brand_value');
        return array_diff($existingOptions, $existingValues);
    }

}
