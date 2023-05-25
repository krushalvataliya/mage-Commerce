<?php 
class Ccc_Krushal_Model_Resource_Krushal extends Mage_Eav_Model_Entity_Abstract
{
	const ENTITY = 'krushal';
	public function __construct()
	{
		$this->setType(self::ENTITY)
			 ->setConnection('core_read', 'core_write');
	   parent::__construct();
    }
}