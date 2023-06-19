<?php
/**
 * 
 */

class Ccc_Practice_Adminhtml_QueryController extends Mage_Adminhtml_Controller_Action
{
    function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/practice'));
        $this->renderLayout();
    }

    public function oneaAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_one'));
        $this->renderLayout();
    }

    public function oneAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_one'));
        $this->renderLayout();
    }

    public function twoAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_two'));
        $this->renderLayout();
    }

    public function threeAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_three'));
        $this->renderLayout();
    }

    public function fourAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_four'));
        $this->renderLayout();
    }

    public function fiveAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_five'));
        $this->renderLayout();
    }

    public function sixAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_six'));
        $this->renderLayout();
    }

    public function sevenAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_seven'));
        $this->renderLayout();
    }

    public function eightAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_eight'));
        $this->renderLayout();
    }

    public function nineAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_nine'));
        $this->renderLayout();
    }

    public function tenAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_ten'));
        $this->renderLayout();
    }

    public function viewoneAction()
    {
        echo "1. Need a list of product with these columns product name, sku, cost, price, color.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "qew";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "dewfwehf";        
        
    }

    public function viewtwoAction()
    {
        echo "2. Need a list of attribute & options. return an array with attribute id, attribute code, option Id, option name.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "qew";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "dewfwehf";
        
    }

    public function viewthreeAction()
    {
        echo "3. Need a list of attribute having options count greater than 10. return array with attribute id, attribute code, option count.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "qew";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "dewfwehf";
        
    }

    public function viewfourAction()
    {
        echo "4. Need list of product with assigned images. return an array with product Id, sku, base image, thumb image, small image.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "qew";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "dewfwehf";
        
    }

    public function viewfiveAction()
    {
        echo "5. Need list of product with gallery image count. return an array with product sku, gallery images count, without consideration of thumb, small, base";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "qew";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "dewfwehf";
        
    }

    public function viewsixAction()
    {
        echo "6. Need list of top to bottom customers with their total order counts. return an array with customer id, customer name, customer email, order count.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "qew";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "dewfwehf";
        
    }

    public function viewsevenAction()
    {
        echo "7. Need list of top to bottom customers with their total order counts, order status wise. return an array with customer id, customer name, customer email, status, order count.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "qew";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "dewfwehf";
        
    }

    public function vieweightAction()
    {
        echo "8. Need list product with number of quantity sold till now for each. return an array with product id, sku, sold quantity.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "qew";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "dewfwehf";
        
    }

    public function viewnineAction()
    {
        echo "9. Need list of those attributes for whose value is not assigned to product. return an array result product wise with these columns product Id, sku, attribute Id, attribute code";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "qew";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "dewfwehf";

        echo "query nine";
        echo "<br>";
         $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect('sku');

       $attributes = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addFieldToFilter('is_user_defined', 1)
            ->getItems();

        foreach ($attributes as $attribute) {
            $attributeCodes[] = $attribute->getAttributeCode();
        }

        $unassignedAttributes = array();

        $products = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('sku');


        foreach ($products as $product) {
            $productId = $product->getId();
            $sku = $product->getSku();

            foreach ($attributeCodes as $attributeCode) {
                $attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
                $attributeId = $attribute->getId();

                $resource = Mage::getResourceModel('catalog/product');
                $value = $resource->getAttributeRawValue($productId, $attributeCode, Mage::app()->getStore());

                if ($value === false || $value === null) {
                    $unassignedAttributes[] = array(
                        'product_id' => $productId,
                        'sku' => $sku,
                        'attribute_id' => $attributeId,
                        'attribute_code' => $attributeCode
                    );
                }
            }
        }
        echo "<pre>";
        print_r($unassignedAttributes);
        die;
        
    }

    public function viewtenAction()
    {
        echo "10. Need list of those attributes for whose value is not assigned to product. return an array result product wise with these columns product Id, sku, attribute Id, attribute code, value.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "qew";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "dewfwehf";
        
    }


    
}