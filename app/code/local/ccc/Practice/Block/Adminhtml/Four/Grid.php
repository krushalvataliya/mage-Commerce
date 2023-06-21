<?php
class Ccc_Practice_Block_Adminhtml_Four_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
        $this->setId('PracticeAdminhtmlPracticeGrid');
    }

    protected function _prepareCollection()
    {
       $products = Mage::getModel('catalog/product')->getCollection();
        $products->addAttributeToSelect(array('name','sku','image','small_image','thumbnail'));
        $this->setCollection($products);
        echo $products->getSelect();

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('product_id', array(
            'header'    => Mage::helper('practice')->__('product_id'),
            'align'     => 'left',
            'index'     => 'entity_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('practice')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        $this->addColumn('base_image', array(
            'header'    => Mage::helper('practice')->__('base image'),
            'align'     => 'left',
            'index'     => 'image',
            'renderer'  =>'ccc_practice_block_adminhtml_four_renderer_image'
        ));

        $this->addColumn('small_image', array(
            'header'    => Mage::helper('practice')->__('small image'),
            'align'     => 'left',
            'index'     => 'small_image',
            'renderer'  =>'Ccc_Practice_Block_Adminhtml_Four_Renderer_Smallimage'
        ));

        $this->addColumn('thumb_image', array(
            'header'    => Mage::helper('practice')->__('thumb image'),
            'align'     => 'left',
            'index'     => 'thumbnail',
            'renderer'  =>'Ccc_Practice_Block_Adminhtml_Four_Renderer_Thumbnail'
        ));


        return parent::_prepareColumns();
    }
   
}