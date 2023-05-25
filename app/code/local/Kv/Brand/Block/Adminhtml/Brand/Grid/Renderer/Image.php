<?php

/**
 * 
 */
class Kv_Brand_Block_Adminhtml_brand_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract		
{
	
	function render($row)
	{
		$name = $row->getImage();
		$path = "<img src='http://127.0.0.1/2023/magento/magento-mirror/media/brand/{$name}' alt='img' width='50' height='60'>";
		return $path;
	}
}