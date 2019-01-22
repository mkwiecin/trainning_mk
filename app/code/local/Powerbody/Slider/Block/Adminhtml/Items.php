<?php


class Powerbody_Slider_Block_Adminhtml_Items extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_items';
        $this->_blockGroup = 'powerbody_slider';
        $this->_headerText = $this->__('Slide Items');
        $this->_addButtonLabel = $this->__('Add New Slide Item');
        parent::__construct();
    }

}