<?php

class Powerbody_Slider_Adminhtml_SliderController extends
    Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }
}