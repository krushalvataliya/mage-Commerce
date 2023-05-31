<?php
/**
 * 
 */
class Ccc_Prectice_QueryController extends Mage_Core_Controller_Front_Action
{
	
	public function indexAction()
	{
		echo "<pre>";
		echo "string";
		$resource = Mage::getSingleton('core/resource');
        $write = $resource->getConnection('core_write');
        $table = $resource->getTableName('product/product');
        $table2 = $resource->getTableName('idx/idx');

        $write->insert(
            $table, 
            ['sku' => 'ABCD', 'cost' => 200]
        );
        //read 
        // left join
        echo $select = $write->select()
            ->from(['tbl' => $table], ['product_id', 'sku'])
            ->joinLeft(['tbl2' => $table2], 'tbl.product_id = tbl2.product_id', ['sku']);   
            ->group('cost')
            ->where('name LIKE ?', "%{$name}%")
        $results = $write->fetchAll($select);

        $write->update(
            $table,
            ['sku' => 'ABCSD', 'cost' => 5000],
            ['product_id = ?' => 12]
        );


        // Delete:

        $write->delete(
            $table,
            ['product_id IN (?)' => [25, 32]]
        );


        // Insert Multiple:

        $data = [
            ['sku'=>'sku4', 'name'=>'name2', 'cost'=>555],
            ['sku'=>'sku55', 'name'=>'name4', 'cost'=>666],
        ];
        $write->insertMultiple($table, $data);


        // Insert Update On Duplicate:

        $data = [];
        $data[] = [
            'sku' => 'BGSDGH',
            'cost' => 50000
        ];

        $write->insertOnDuplicate(
            $table,
            $data, 
            ['cost'] 
        );

        // insert on duplicate table to table

        // INSERT INTO catalog_product_entity_int (entity_type_id, attribute_id, store_id,entity_id,value) SELECT 4 , 98 , 0 , product_id , status FROM import_product_idx AS s ON DUPLICATE KEY UPDATE value = s.status;
		
	}
}