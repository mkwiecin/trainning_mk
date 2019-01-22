<?php

class Powerbody_Slider_Block_Adminhtml_Items_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'powerbody_slider';
        $this->_controller = 'adminhtml_items';
        $this->_updateButton('save', 'label', Mage::helper
        ('powerbody_slider')->__('Save slide item'));
        $this->_updateButton('delete', 'label',
            Mage::helper('powerbody_slider')->__('Delete slide item'));
    }

    public function getHeaderText()
    {
        if (Mage::registry('slider_item') && Mage::registry('slider_item')->getId()) {
            return Mage::helper('powerbody_slider')
                ->__("Edit Slide Item '%s'",
                    $this->htmlEscape(Mage::registry('slider_item')->getName()));
        }

        return Mage::helper('powerbody_slider')->__('Add slide item');
    }
}