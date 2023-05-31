<?php

class Kv_Idx_ImportController extends Mage_Adminhtml_Controller_Action
{
    public function importAction()
    {
            $csvFile = $_FILES['import_options']['tmp_name'];
            $csvData = file_get_contents($csvFile);
            $csvData = array();

            if (($handle = fopen($csvFile, 'r')) !== false) {
                while (($data = fgetcsv($handle)) !== false) {
                    $row = array();
                    foreach ($data as $value) {
                        $row[] = $value;
                    }
                    $csvData[] = $row;
                }
                  fclose($handle);
            }
            $header = [];
            $idxModel = Mage::getModel('idx/idx');
            
            $this->_deleteOldEntries();
            foreach ($csvData as $value)
            {
                if(!$header)
                {
                    $header = $value;
                }
                else
                {
                    $data = array_combine($header,$value);
                    $idxModel->insertOnDuplicate($data, array_keys($data));
                }
            }
        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('idx')->__('Data Imported successfully.'));
        $this->_redirect('*/adminhtml_idx/index');
    }

    protected function _deleteOldEntries()
    {
        $write = Mage::getSingleton('core/resource')->getConnection('core_write');
        $tableName = Mage::getSingleton('core/resource')->getTableName('import_product_idx');
        if($write->truncateTable($tableName))
        {
            return true;
        }
        return false;

    }
}
