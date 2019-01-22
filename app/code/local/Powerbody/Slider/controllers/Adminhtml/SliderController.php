<?php

class Powerbody_Slider_Adminhtml_SliderController extends
    Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/sliders/groups');
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

}