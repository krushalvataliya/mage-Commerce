
<?php 
require_once('app/Mage.php');
Mage::app();


// Create a collection object for the 'sales/order' table
$collection = Mage::getModel('sales/order')->getCollection();

// Apply a filter to retrieve orders with a specific status
$collection->addFieldToFilter('status', 'complete');

// Join the 'sales_flat_order_item' table to retrieve item quantities
$collection->join(
    array('items' => 'sales/order_item'),
    'main_table.entity_id = items.order_id',
    array()
);

// Add an expression field to select the total quantity of items per order
$collection->getSelect()->columns(
    array('total_quantity' => new Zend_Db_Expr('SUM(items.qty_ordered)'))
);

// Group the collection by order ID
$collection->getSelect()->group('main_table.entity_id');
echo $collection->getSelect();
die;

// Retrieve the orders and their total item quantities
foreach ($collection as $order) {
    $orderId = $order->getId();
    $totalQuantity = $order->getData('total_quantity');

    echo "Order ID: " . $orderId . "\n";
    echo "Total Quantity: " . $totalQuantity . "\n";
    echo "\n";
}











 ?>




















<?php
die;

// debug xml file
require_once('app/Mage.php');

umask(0);
Mage::app();


// enable user error handling
libxml_use_internal_errors(true);

// adjust template path
$dir = "app/design/adminhtml/default/default/layout/*";

foreach(glob($dir) as $file) {
    $xml = simplexml_load_file($file);
    foreach (libxml_get_errors() as $error) {
        print_r($error);
        // Mage::log($error);
    echo 123;
    }
    libxml_clear_errors();
}