<?php

/**
 * 
 */
class Kv_Banner_Block_Adminhtml_banner_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract		
{
	
	public function render(Varien_Object $row)
    {
        $imageUrl = $row->getData($this->getColumn()->getIndex());
        if ($imageUrl) {
            $imagePath = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $imageUrl;
            $imageHtml = '<img src="' . $imagePath . '" width="50" height="50" />';
            return $imageHtml;
        }
        return '';
    }
}