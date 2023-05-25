<?php
class Ccc_Krushal_Block_Adminhtml_Krushal_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{	
	public function __construct()
	{		
		$this->_blockGroup = 'krushal';
        $this->_controller = 'adminhtml_krushal';
        $this->_headerText = 'Add Krushal';
        parent::__construct();
        if(!$this->getRequest()->getParam('set') && !$this->getRequest()->getParam('id'))
		{
			$this->_removeButton('save');
		} 
	}
}