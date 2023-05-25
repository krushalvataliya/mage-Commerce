<?php

/**
 * 
 */
class Ccc_Category_Block_Adminhtml_category_Grid_Renderer_Status extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract		
{
	
	function render($row)
	{
		if($row->getStatus() == 1)
		{
			return "Active";
		}
			return "Inactive";
	}
}