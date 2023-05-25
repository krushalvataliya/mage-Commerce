<?php
class Ccc_Krushal_Model_Resource_Krushal_Collection extends Mage_Catalog_Model_Resource_Collection_Abstract
{
	public function __construct()
	{
		$this->setEntity('krushal');
		parent::__construct();	
	}
}