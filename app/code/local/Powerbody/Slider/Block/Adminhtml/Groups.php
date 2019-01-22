<?php


class Powerbody_Slider_Block_Adminhtml_Groups extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_groups';
        $this->_blockGroup = 'powerbody_slider';
        $this->_headerText = $this->__('Slides Group');
        $this->_addButtonLabel = $this->__('Add New Slide Group');
        parent::__construct();
    }

}