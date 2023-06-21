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
        echo "Mage::getModel('catalog/product')->getCollection()->addAttributeToSelect(array('name','cost','color','price'));";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "SELECT `e`.*, `at_name`.`value` AS `name`, `at_cost`.`value` AS `cost`, `at_price`.`value` AS `price`, `at_color`.`value` AS `color` FROM `catalog_product_entity` AS `e` LEFT JOIN `catalog_product_entity_varchar` AS `at_name` ON (`at_name`.`entity_id` = `e`.`entity_id`) AND (`at_name`.`attribute_id` = '73') AND (`at_name`.`store_id` = 0) LEFT JOIN `catalog_product_entity_decimal` AS `at_cost` ON (`at_cost`.`entity_id` = `e`.`entity_id`) AND (`at_cost`.`attribute_id` = '81') AND (`at_cost`.`store_id` = 0) LEFT JOIN `catalog_product_entity_decimal` AS `at_price` ON (`at_price`.`entity_id` = `e`.`entity_id`) AND (`at_price`.`attribute_id` = '77') AND (`at_price`.`store_id` = 0) LEFT JOIN `catalog_product_entity_int` AS `at_color` ON (`at_color`.`entity_id` = `e`.`entity_id`) AND (`at_color`.`attribute_id` = '94') AND (`at_color`.`store_id` = 0)";        
        
    }

    public function viewtwoAction()
    {
        echo "2. Need a list of attribute & options. return an array with attribute id, attribute code, option Id, option name.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        print("{'$attributeCollection'} = Mage::getResourceModel('eav/entity_attribute_collection');
        
                $attributeOptionCollection = Mage::getResourceModel('eav/entity_attribute_option_collection');
        
                $attributeOptionCollection->getSelect()
                    ->join(
                        array('attribute' => $attributeCollection->getTable('eav/attribute')),
                        'attribute.attribute_id = main_table.attribute_id',
                        array('attribute_code' => 'attribute.attribute_code')
                    );
        
                $attributeOptionCollection->getSelect()->columns(array(
                    'attribute_id' => 'main_table.attribute_id',
                    'attribute_code' => 'attribute.attribute_code',
                    'option_id' => 'main_table.option_id',
                ));
        ");        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "SELECT COUNT(*) FROM `eav_attribute_option` AS `main_table`
         INNER JOIN `eav_attribute` AS `attribute` ON attribute.attribute_id = main_table.attribute_id <br>
        SELECT `main_table`.*, `attribute`.`attribute_code`, `main_table`.`attribute_id`, `attribute`.`attribute_code`, `main_table`.`option_id` FROM `eav_attribute_option` AS `main_table`
         INNER JOIN `eav_attribute` AS `attribute` ON attribute.attribute_id = main_table.attribute_id LIMIT 20 <br>
         SELECT `eav_attribute_option_value`.`option_id`, `eav_attribute_option_value`.`value` FROM `eav_attribute_option_value`";
        
    }

    public function viewthreeAction()
    {
        echo "3. Need a list of attribute having options count greater than 10. return array with attribute id, attribute code, option count.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "attributeOptionCollection = Mage::getResourceModel('eav/entity_attribute_option_collection')
                ->addFieldToFilter('option_id', array('gt' => 0))
                ->getSelect()
                ->join(
                    array('attribute' => Mage::getSingleton('core/resource')->getTableName('eav/attribute')),
                    'attribute.attribute_id = main_table.attribute_id',
                    array('attribute_code' => 'attribute.attribute_code')
                )
                ->columns(array('option_count' => new Zend_Db_Expr('COUNT(main_table.option_id)')))
                ->group('main_table.attribute_id')
                ->having('option_count > ?', 10);

                <br>
            resultCollection = Mage::getModel('eav/entity_attribute')->getCollection();
                <br>
            resultCollection->getSelect()->reset()->from(array('main_table' => attributeOptionCollection));";        
        echo "<br>";        
        echo "<br>";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "SELECT COUNT(*) FROM (SELECT `main_table`.*, `attribute`.`attribute_code`, COUNT(main_table.option_id) AS `option_count` FROM `eav_attribute_option` AS `main_table`
         INNER JOIN `eav_attribute` AS `attribute` ON attribute.attribute_id = main_table.attribute_id WHERE (`option_id` > 0) GROUP BY `main_table`.`attribute_id` HAVING (option_count > 10)) AS `main_table`<br>
        SELECT `main_table`.* FROM (SELECT `main_table`.*, `attribute`.`attribute_code`, COUNT(main_table.option_id) AS `option_count` FROM `eav_attribute_option` AS `main_table`<br>
         INNER JOIN `eav_attribute` AS `attribute` ON attribute.attribute_id = main_table.attribute_id WHERE (`option_id` > 0) GROUP BY `main_table`.`attribute_id` HAVING (option_count > 10)) AS `main_table` LIMIT 20";
        
    }

    public function viewfourAction()
    {
        echo "4. Need list of product with assigned images. return an array with product Id, sku, base image, thumb image, small image.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "select = readConnection->select()
            ->from(
                array('main_table'=> resource->getTableName('catalog_product_entity')),
                array('entity_id','sku')
            )<br>
            ->joinLeft(
                array('vc'=>resource->getTableName('catalog_product_entity_varchar')),
                'vc.entity_id = main_table.entity_id AND vc.attribute_id = 87',
                array('image' => 'vc.value')
            )
            <br>
            ->joinLeft(
                array('thumb'=>resource->getTableName('catalog_product_entity_varchar')),
                'thumb.entity_id = main_table.entity_id AND thumb.attribute_id = 89',
                array('thumbnail' => 'thumb.value')
            )
            <br>
            ->joinLeft(
                array('small'=>resource->getTableName('catalog_product_entity_varchar')),
                'small.entity_id = main_table.entity_id AND small.attribute_id = 88',
                array('small' => 'small.value')
            );";        
        echo "<br>";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        echo $select = $readConnection->select()
            ->from(
                array('main_table'=> $resource->getTableName('catalog_product_entity')),
                array('entity_id','sku')
            )
            ->joinLeft(
                array('vc'=>$resource->getTableName('catalog_product_entity_varchar')),
                'vc.entity_id = main_table.entity_id AND vc.attribute_id = 87',
                array('image' => 'vc.value')
            )
            ->joinLeft(
                array('thumb'=>$resource->getTableName('catalog_product_entity_varchar')),
                'thumb.entity_id = main_table.entity_id AND thumb.attribute_id = 89',
                array('thumbnail' => 'thumb.value')
            )
            ->joinLeft(
                array('small'=>$resource->getTableName('catalog_product_entity_varchar')),
                'small.entity_id = main_table.entity_id AND small.attribute_id = 88',
                array('small' => 'small.value')
            );
        
    }

    public function viewfiveAction()
    {
        echo "5. Need list of product with gallery image count. return an array with product sku, gallery images count, without consideration of thumb, small, base";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "Mage::getModel('catalog/product')->getCollection()
                    ->addAttributeToSelect(array('sku','media_gallery'));";        
        echo "<br>";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "SELECT `e`.* FROM `catalog_product_entity` AS `e` LIMIT 20 <br>
                SELECT `catalog_product_entity_varchar`.`entity_id`, `catalog_product_entity_varchar`.`attribute_id`, `catalog_product_entity_varchar`.`value` FROM `catalog_product_entity_varchar` WHERE (entity_type_id =4) AND (entity_id IN (92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 109, 110)) AND (attribute_id IN ('76', '90')) AND (store_id = 0) <br>";
        
    }

    public function viewsixAction()
    {
        echo "6. Need list of top to bottom customers with their total order counts. return an array with customer id, customer name, customer email, order count.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "customerCollection = Mage::getModel('customer/customer')->getCollection();<br>
        customerCollection->addAttributeToSelect(array('entity_id', 'firstname', 'lastname', 'email'));<br>
         customerCollection->getSelect()->joinLeft(
            array('o' => Mage::getSingleton('core/resource')->getTableName('sales/order')),
            'o.customer_id = e.entity_id',
            array('order_count' => 'COUNT(o.entity_id)')
        )
        ->group('e.entity_id')
        ->order(array('order_count DESC'));";        
        echo "<br>";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "SELECT `e`.*, COUNT(o.entity_id) AS `order_count` FROM `customer_entity` AS `e` LEFT JOIN `sales_flat_order` AS `o` ON o.customer_id = e.entity_id WHERE (`e`.`entity_type_id` = '1') GROUP BY `e`.`entity_id` ORDER BY `order_count` DESC";

        
    }

    public function viewsevenAction()
    {
        echo "7. Need list of top to bottom customers with their total order counts, order status wise. return an array with customer id, customer name, customer email, status, order count.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "collection = Mage::getModel('sales/order')->getCollection()
            ->addFieldToSelect(array('entity_id', 'customer_id'))
            ->addFieldToFilter('main_table.status', array('in' => $orderStatuses));

        collection->getSelect()->join(
            array('status' => Mage::getSingleton('core/resource')->getTableName('sales/order_status')),
            'status.status = main_table.status',
            array('order_status' => 'status.label')
        );

        collection->getSelect()->join(
            array('customer' => Mage::getSingleton('core/resource')->getTableName('customer/entity')),
            'customer.entity_id = main_table.customer_id',
            array('email' => 'customer.email')
        );";        
        echo "<br>";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "SELECT `main_table`.`entity_id`, `main_table`.`entity_id`, `main_table`.`customer_id`, `status`.`label` AS `order_status`, `customer`.`email` FROM `sales_flat_order` AS `main_table` INNER JOIN `sales_order_status` AS `status` ON status.status = main_table.status INNER JOIN `customer_entity` AS `customer` ON customer.entity_id = main_table.customer_id WHERE (`main_table`.`status` IN('pending', 'processing', 'complete', 'closed', 'canceled', 'holded', 'payment_review'))";
        
    }

    public function vieweightAction()
    {
        echo "8. Need list product with number of quantity sold till now for each. return an array with product id, sku, sold quantity.";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo " collection = Mage::getResourceModel('sales/order_item_collection');

        collection->getSelect()
            ->columns(array('product_id', 'sku', 'total_qty_ordered' => 'SUM(qty_ordered)'))
            ->group('product_id');";        
        echo "<br>";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";        
        echo "SELECT `main_table`.*, `main_table`.`product_id`, `main_table`.`sku`, SUM(qty_ordered) AS `total_qty_ordered` FROM `sales_flat_order_item` AS `main_table` GROUP BY `product_id`";
        
    }

    public function viewnineAction()
    {
        echo "9. Need list of those attributes for whose value is not assigned to product. return an array result product wise with these columns product Id, sku, attribute Id, attribute code";
        echo "<br>";        
        echo "magento query :";        
        echo "<br>";        
        echo "  select = connection->select()
            ->from(array('e' => 'catalog_product_entity'), 'entity_id AS product_id')
            ->join(
                array('a' => 'eav_attribute'),
                'e.entity_type_id = a.entity_type_id',
                array('attribute_id', 'attribute_code')
            )
            ->joinLeft(
                array('avc' => 'catalog_product_entity_varchar'),
                'e.entity_id = avc.entity_id AND avc.attribute_id = a.attribute_id',
                array()
            )
            ->joinLeft(
                array('avi' => 'catalog_product_entity_int'),
                'e.entity_id = avi.entity_id AND avi.attribute_id = a.attribute_id',
                array()
            )
            ->joinLeft(
                array('avd' => 'catalog_product_entity_decimal'),
                'e.entity_id = avd.entity_id AND avd.attribute_id = a.attribute_id',
                array()
            )
            ->joinLeft(
                array('avt' => 'catalog_product_entity_text'),
                'e.entity_id = avt.entity_id AND avt.attribute_id = a.attribute_id',
                array()
            )
            ->where('avc.value IS NULL AND avi.value IS NULL AND avd.value IS NULL AND avt.value IS NULL')
            ->where('a.is_user_defined = ?', 1);";        
        echo "<br>";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";    
        $resource = Mage::getSingleton('core/resource');
        $connection = $resource->getConnection('core_read');    
          echo $select = $connection->select()
        ->from(array('e' => 'catalog_product_entity'), 'entity_id AS product_id')
        ->join(
            array('a' => 'eav_attribute'),
            'e.entity_type_id = a.entity_type_id',
            array('attribute_id', 'attribute_code')
        )
        ->joinLeft(
            array('avc' => 'catalog_product_entity_varchar'),
            'e.entity_id = avc.entity_id AND avc.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avi' => 'catalog_product_entity_int'),
            'e.entity_id = avi.entity_id AND avi.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avd' => 'catalog_product_entity_decimal'),
            'e.entity_id = avd.entity_id AND avd.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avt' => 'catalog_product_entity_text'),
            'e.entity_id = avt.entity_id AND avt.attribute_id = a.attribute_id',
            array()
        )
        ->where('avc.value IS NULL AND avi.value IS NULL AND avd.value IS NULL AND avt.value IS NULL')
        ->where('a.is_user_defined = ?', 1);

        echo "<br>";
        echo "<br>";
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
        echo "select = connection->select()<br>
        ->from(array('e' => 'catalog_product_entity'), 'entity_id AS product_id')
        ->join(
            array('a' => 'eav_attribute'),
            'e.entity_type_id = a.entity_type_id',
            array('attribute_id', 'attribute_code')
        )<br>
        ->joinLeft(
            array('avc' => 'catalog_product_entity_varchar'),
            'e.entity_id = avc.entity_id AND avc.attribute_id = a.attribute_id',
            array()
        )<br>
        ->joinLeft(
            array('avi' => 'catalog_product_entity_int'),
            'e.entity_id = avi.entity_id AND avi.attribute_id = a.attribute_id',
            array()
        )<br>
        ->joinLeft(
            array('avd' => 'catalog_product_entity_decimal'),
            'e.entity_id = avd.entity_id AND avd.attribute_id = a.attribute_id',
            array()
        )<br>
        ->joinLeft(
            array('avt' => 'catalog_product_entity_text'),
            'e.entity_id = avt.entity_id AND avt.attribute_id = a.attribute_id',
            array()
        )<br>
        ->columns(array('value' => new Zend_Db_Expr('COALESCE(avc.value, avi.value, avd.value, avt.value)')))<br>
        ->where('avc.value IS NOT NULL OR avi.value IS NOT NULL OR avd.value IS NOT NULL OR avt.value IS NOT NULL')<br>
        ->where('a.is_user_defined = ?', 1);";        
        echo "<br>";        
        echo "<br>";        
        echo "sql query :";        
        echo "<br>";   
        $resource = Mage::getSingleton('core/resource');
        $connection = $resource->getConnection('core_read'); 

         echo $select = $connection->select()
        ->from(array('e' => 'catalog_product_entity'), 'entity_id AS product_id')
        ->join(
            array('a' => 'eav_attribute'),
            'e.entity_type_id = a.entity_type_id',
            array('attribute_id', 'attribute_code')
        )
        ->joinLeft(
            array('avc' => 'catalog_product_entity_varchar'),
            'e.entity_id = avc.entity_id AND avc.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avi' => 'catalog_product_entity_int'),
            'e.entity_id = avi.entity_id AND avi.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avd' => 'catalog_product_entity_decimal'),
            'e.entity_id = avd.entity_id AND avd.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avt' => 'catalog_product_entity_text'),
            'e.entity_id = avt.entity_id AND avt.attribute_id = a.attribute_id',
            array()
        )
        ->columns(array('value' => new Zend_Db_Expr('COALESCE(avc.value, avi.value, avd.value, avt.value)')))
        ->where('avc.value IS NOT NULL OR avi.value IS NOT NULL OR avd.value IS NOT NULL OR avt.value IS NOT NULL')
        ->where('a.is_user_defined = ?', 1);
    }

    public function testAction()
    {

        print_r(Mage::getModel('practice/practice')->getAttributeArrayWithOptionCount());
        die;
        $attributes = Mage::getModel('eav/entity_attribute')->getCollection();
        $attributes->addFieldToFilter('is_user_defined', 1 );
        // $attributes->addFieldToFilter('frontend_input', array('select','multiselect') );

        $readConnection = Mage::getSingleton('core/resource')->getConnection('core_read');
        $optionsTable = Mage::getSingleton('core/resource')->getTableName('eav_attribute_option');
        $optionsValueTable = Mage::getSingleton('core/resource')->getTableName('eav_attribute_option_value');

        foreach ($attributes as $attribute) {
                if ($attribute->getSourceModel()) {
                    $options = $attribute->getSource()->getAllOptions(false);
                    foreach ($options as $option) {
                        $data[] = array(
                            'attribute_id'=>$attribute->getId(),
                            'attribute_code'=>$attribute->getAttributeCode(),
                            'option_id'=>$option['value'],
                            'option_name'=>$option['label'],
                        );
                    }
                } else {
                    $query = $readConnection->select()
                        ->from(array('ao' => $optionsTable), array('option_id', 'sort_order'))
                        ->joinLeft(array('aov' => $optionsValueTable), 'aov.option_id = ao.option_id', array('value'))
                        ->where('ao.attribute_id = ?', $attribute->getId())
                        ->order('ao.sort_order ASC');
                    $options = $readConnection->fetchAll($query);
                    foreach ($options as $option) {
                        $data[] = array(
                                'attribute_id'=>$attribute->getId(),
                                'attribute_code'=>$attribute->getAttributeCode(),
                                'option_id'=>$option['option_id'],
                                'option_name'=>$option['value'],
                        );
                    }
                }
        }
        echo "<pre>";
        print_r($data);
        die;
        $attributes = Mage::getResourceModel('catalog/eav_attribute_collection')
            ->addFieldToFilter('is_user_defined', 1)
            ->getItems();

        foreach ($attributes as $attribute) {
            // $attributeCodes[] = $attribute->getAttributeCode();

            $attributeCode = $attribute->getAttributeCode();

            if(!$attribute->getsourceModel())
            {
                echo "<br>";
                echo $attribute->getAttributeCode();
                echo "<br>";
                echo "sdsd";
                echo "<br>";
            }
            else
            {
                echo "<br>";
                echo "<br>";

                echo "<br>";
                echo $attribute->getAttributeCode();
                echo "<br>";
                $model = Mage::getModel('eav/config');
                $sourceModel = $model->getAttribute('catalog_product', $attributeCode)->getSource();
                $options = $sourceModel->getAllOptions(false);
                print_r($options);
                echo "<br>";
            }

        }

        die;
        die;
        die;

        //-----------------------------------------------------------------------------------------

        $attributeCode = 'brand';
        $model = Mage::getModel('eav/config');
        $sourceModel = $model->getAttribute('catalog_product', $attributeCode)->getSource();
        $options = $sourceModel->getAllOptions(false);

        // -----------------------------------------------------------------------------------------

        $attributeOptionCollection = Mage::getResourceModel('eav/entity_attribute_option_collection')
            ->addFieldToFilter('option_id', array('gt' => 0))
            ->getSelect()
            ->join(
                array('attribute' => Mage::getSingleton('core/resource')->getTableName('eav/attribute')),
                'attribute.attribute_id = main_table.attribute_id',
                array('attribute_code' => 'attribute.attribute_code')
            )
            ->joinLeft(
                array('source' => Mage::getSingleton('core/resource')->getTableName('brand')),
                'source.brand_id = main_table.option_id',
                array('external_value' => 'source.name') // Replace 'external_value' and 'source.value' with appropriate field names
            )
            ->columns(array('option_count' => new Zend_Db_Expr('COUNT(main_table.option_id)')))
            ->group('main_table.attribute_id')
            ->having('option_count > ?', 1);

        $resultCollection = Mage::getModel('eav/entity_attribute')->getCollection();
        echo $resultCollection->getSelect()->reset()->from(array('main_table' => $attributeOptionCollection));

    }


    
}