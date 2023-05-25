<?php

class Ccc_Product_Model_Products extends Mage_Catalog_Model_Product
{
    public function getPrice()
    {
        return 5000;
    }
    public function getStatus()
    {
        
        return 2;
    }
        public function getGroupPrice()
    {
        return 1;
    }

    public function getTierPrice($qty=null)
    {
        return 1;
    }
     protected function _afterSave()
    {
        echo 'this product price is ';
        echo $this->getPrice();
        // die();  
          }

}
