<?php


class Powerbody_Slider_Block_Adminhtml_Items extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_items';
        $this->_blockGroup = 'powerbody_slider';
        $this->_headerText = Mage::helper('powerbody_slider')->__('Slide Item');
        parent::__construct();
        $this->_removeButton('add');
    }

}