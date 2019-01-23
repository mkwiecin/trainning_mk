<?php

class Powerbody_Slider_Block_Adminhtml_Items_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'powerbody_slider';
        $this->_controller = 'adminhtml_items';
        $this->_updateButton('save', 'label', Mage::helper('powerbody_slider')->__('Save slide item'));
        $this->_updateButton('delete', 'label', $this->__('Delete slide item'));
    }

    public function getHeaderText(): string
    {
        if (Mage::registry('slider_item') && Mage::registry('slider_item')->getId()) {

        	return $this->__("Edit Slide Item", $this->htmlEscape(Mage::registry('slider_item')->getName()));
        }

        return $this->__('Add slide item');
    }
}
