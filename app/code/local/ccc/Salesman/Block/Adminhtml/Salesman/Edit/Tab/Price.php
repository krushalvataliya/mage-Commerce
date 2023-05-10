<?php

class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Price extends Mage_Adminhtml_Block_Widget_Form
{

    public function __construct()
    {
        $this->setTemplate('salesman/grid.phtml');
    }

    public function getSalesmen()
    {
        $modelSalesmanPrice =Mage::getModel('Salesman/salesman');
        $sql="SELECT * FROM `salesmen` ORDER BY `first_name` ASC";
        $salesmen = $modelSalesmanPrice->fetchAll($sql);
        return $salesmen;
    }

    public function getSalesmanPrice()
    {
        $request = $this->getRequest();
        $id=(int)$request->getParam('salesman_id');
        $modelSalesmanPrice =Mage::getModel('Salesman/Salesman_Price');
        $sql = "SELECT SP.entity_id, SP.salesman_price, P.sku, P.cost, P.price, P.product_id 
        FROM `products` P 
        LEFT JOIN `salesman_price` SP ON P.product_id = SP.product_id AND SP.salesman_id = ".$id."";
        $prices = $modelSalesmanPrice->fetchAll($sql);
        return $prices;
    }
   

}





    