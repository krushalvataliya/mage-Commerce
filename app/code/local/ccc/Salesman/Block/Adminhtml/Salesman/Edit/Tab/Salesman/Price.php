<?php

class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Salesman_Price extends Mage_Adminhtml_Block_Widget_Form
{
    function __construct()
    {
        $this->setTemplate('salesman/price.phtml');
    }

    public function getSalesmanPrice()
    {
        $salesmanId = $this->getRequest()->getParam('id');
        $coreResource = Mage::getSingleton('core/resource');
        $connection = $coreResource->getConnection('core_read');
        $sql = "SELECT SP.entity_id, SP.salesman_price, P.sku, P.cost, P.price, P.product_id 
        FROM `product` P 
        LEFT JOIN `salesman_price` SP ON P.product_id = SP.product_id";
        $prices=$connection->fetchAll($sql);
        return $prices;
        // return 11;
    }
}





    