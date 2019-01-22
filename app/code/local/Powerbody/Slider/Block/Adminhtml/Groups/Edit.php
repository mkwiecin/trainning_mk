<?php

class Powerbody_Slider_Block_Adminhtml_Groups_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'powerbody_slider';
        $this->_controller = 'adminhtml_groups';
        $this->_updateButton('save', 'label', $this->__('Save slides group'));
        $this->_updateButton('delete', 'label',
            $this->__('Delete slides group'));
    }

    public function getHeaderText()
    {
        if (Mage::registry('slider_group') && Mage::registry('slider_group')->getId())
        {
            return $this->__("Edit Slides Group '%s'",
                    $this->htmlEscape(Mage::registry('slider_group')->getName()));
        }

        return $this->__('Add slides group');
    }
}