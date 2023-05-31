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

    public function importAction()
    {

        $this->_title($this->__('Import'))
             ->_title($this->__('import Data'));
            $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('idx/adminhtml_idx_import'))
                ->_addLeft($this->getLayout()
                ->createBlock('idx/adminhtml_idx_import_tabs'));

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function importfAction()
    {
        print_r($_POST);
        print_r($_FILES['variable']);

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

    public function collectionAction()
    {
         try {
            
            $idx = Mage::getModel('idx/idx');       
            $idxCollection = $idx->getCollection();
            $idxCollectionArray = $idx->getCollection()->getData();

            $idxBrandId = array_column($idxCollectionArray,'idx_id');
            $idxCollectionNames = array_column($idxCollectionArray,'collection');
            $idxCollectionNames = array_combine($idxBrandId,$idxCollectionNames);

            $idx->updateCollectionAttribute(array_unique($idxCollectionNames));

            $write = Mage::getSingleton('core/resource')->getConnection('core_write');
            $sourceTable = Mage::getSingleton('core/resource')->getTableName('eav_attribute_option_value');
            $destinationTable = Mage::getSingleton('core/resource')->getTableName('import_product_idx');

            $query = "UPDATE {$destinationTable} AS dest
                      INNER JOIN {$sourceTable} AS src ON dest.collection = src.value
                      SET dest.collection_id = src.option_id";
            $write->query($query);
            Mage::getSingleton('adminhtml/session')->addSuccess('Collection is fine now');
        } catch (Exception $e) {
            Mage::logException($e);
        }
            $this->_redirect('*/*/index');
    }

    public function brandAction()
    {
        try {
            
            $idx = Mage::getModel('idx/idx');       
            $idxCollection = $idx->getCollection();
            $idxCollectionArray = $idx->getCollection()->getData();

            $idxBrandId = array_column($idxCollectionArray,'idx_id');
            $idxBrandNames = array_column($idxCollectionArray,'brand');
            $idxBrandNames = array_combine($idxBrandId,$idxBrandNames);

            $newBrands = $idx->updateBrandTable(array_unique($idxBrandNames));

            $idxCollection = $idx->getCollection();

            foreach ($idxCollection as $idx) {
                if(!$idx->brand_id)
                {
                    $brand = Mage::getModel('brand/brand');
                    $brandCollection = Mage::getModel('brand/brand')->getCollection();
                    $brandCollection->getSelect()->where('main_table.name=?',$idx->brand);
                    $brandData = $brandCollection->getData();
                    $idxModel = Mage::getModel('idx/idx');
                    $idxModel->idx_id = $idx->idx_id;
                    $idxModel->brand_id = $brandData[0]['brand_id'];
                    $idxModel->save();
                }
            }
            Mage::getSingleton('adminhtml/session')->addSuccess('Brand is fine now');
        } catch (Exception $e) {
            Mage::logException($e);
        }
            $this->_redirect('*/*/index');
    }

    

    public function productAction()
    {
        try {
            $idx = Mage::getModel('idx/idx');
            $idxCollection = $idx->getCollection();
            foreach ($idxCollection as $idx) {
                if (!$idx->checkBrand()) {
                    Mage::getSingleton('adminhtml/session')->addNotice('Brand is not fine');
                    $this->_redirect('*/*/');
                    return;
                }

                if (!$idx->checkCollection()) {
                    Mage::getSingleton('adminhtml/session')->addNotice('Collection is not fine');
                    $this->_redirect('*/*/');
                    return;
                }
            }

            $idxSku = [];
            $idxCollection->addFieldToSelect(array('sku', 'name', 'price','cost','quantity','description'));
            $idxCollectionArray = $idxCollection->getData();
            $idxSku = array_column($idxCollectionArray, 'sku');

            $idxProductData = $idxCollection->getData();
            $idx->updateProductAttribute($idxProductData);

           $write = Mage::getSingleton('core/resource')->getConnection('core_write');
            $sourceTable = Mage::getSingleton('core/resource')->getTableName('catalog_product_entity');
            $destinationTable = Mage::getSingleton('core/resource')->getTableName('import_product_idx');

            $query = "UPDATE {$destinationTable} AS dest
                      INNER JOIN {$sourceTable} AS src ON dest.sku = src.sku
                      SET dest.product_id = src.entity_id";
            $write->query($query);

        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

}
