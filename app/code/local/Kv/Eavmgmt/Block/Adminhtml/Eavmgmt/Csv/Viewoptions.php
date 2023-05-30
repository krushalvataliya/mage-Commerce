<?php

class Kv_Eavmgmt_Block_Adminhtml_Eavmgmt_Csv_Viewoptions extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract		
{
	
	function render($row)
	{
		$inputType = $row->getFrontendInput();
		$inputTypes = ['multiselect','select'];
		if(in_array($inputType, $inputTypes))
		{
			$collection = Mage::getModel('eav/entity_attribute_option')->getCollection();
			$collection->getSelect()->where('attribute_id=?',$row->getId());
			$link = "<a href='{$this->getUrl('*/*/showoption',['eavmgmt_id'=> $row->getId()])}'>show options(".$collection->getSize().")</a>";
			return $link;
		}
		return null;
	}
}