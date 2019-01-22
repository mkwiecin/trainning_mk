<?php

class Powerbody_Slider_Adminhtml_ItemController extends
    Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed(): bool
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/sliders/items');
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();

        return $this;
    }

}