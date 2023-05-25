<?php
class Ccc_Practice_Class_OneController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
    {
        echo "<pre>";

        echo Mage::getVersion();

        echo "<br>";
        print_r(Mage::getVersionInfo());
        echo "<br>";

        print_r(Mage::getEdition());
        echo "<br>";

        Mage::register('hello','helloqq');
        print_r(Mage::registry('hello'));
        echo "<br>";

         print_r(Mage::getEvents());
        echo "<br>";

        print_r(Mage::objects());
        echo "<br>";

        print_r(Mage::getBaseDir());
        echo "<br>";

        print_r(Mage::getModuleDir('controllers','product'));
        echo "<br>";

        print_r(Mage::getStoreConfig());
        echo "<br>";



            print_r(get_class_methods(new Mage));


        // //1. How you will prepare different types of queries and take a collection of rows in  object format and array format.

        // $collection = Mage::getModel('product/product')->getCollection();

        // // collection of rows in  object format.
        // print_r($collection->getItems());

        // // collection of rows in array format.
        // // print_r($collection->toArray());

        // // prepare different types of queries
        
        // $read = Mage::getSingleton('core/resource')->getConnection('core_read');
        
        // $select = $read->select()
        //     ->from('product', array('sku', 'cost', 'price'))
        //     ->where('status = ?', 1);
        // $rows = $read->fetchAll($select);

        // print_r($rows);

        die;
    }

}