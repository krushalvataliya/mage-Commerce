<?php
class Kv_Banner_Block_Adminhtml_Bannergroup_Edit_Tab_Banner extends Mage_Adminhtml_Block_Catalog_Form
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate('banner/gallery.phtml');

        $this->setChild('uploader',
            $this->getLayout()->createBlock('uploader/multiple')
        );
    }

    public function getBannerCollection()
    {
        $bannerId = $this->getRequest()->getParam('banner_id');
        $collection = Mage::getModel('banner/banner')->getCollection();
        $collection->addorder('position','ASC');
        $collection->addFieldToFilter('group_id', $bannerId);

        return $collection;
    }
}