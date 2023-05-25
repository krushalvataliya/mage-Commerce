<?php 
class Ccc_Krushal_Block_Adminhtml_Krushal extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'krushal';
		$this->_controller = 'adminhtml_krushal';
		$this->_headerText = $this->__('Krushal Grid');
		$this->_addButtonLabel = $this->__('Add Krushal');
		parent::__construct();
	}
}