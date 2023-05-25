<?php 

class Ccc_Salesman_Block_Adminhtml_Salesman_Grid_renderer_gender extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract		
{
	
	function render($row)
	{
		if($row->getGender() == 1)
		{
			return "Male";
		}
			return "Female";
	}
}