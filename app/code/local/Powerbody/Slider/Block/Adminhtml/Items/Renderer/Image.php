<?php

class Powerbody_Slider_Block_Adminhtml_Items_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row): string
    {
        $image = $row->getBgImage();
        $gridImageSrc = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'slider/' . $image;
        $html = '<img ';
        $html .= 'width="40" ';
        $html .= 'height="40" ';
        $html .= 'src="' . $gridImageSrc . '" />';

        return $html;
    }
}
