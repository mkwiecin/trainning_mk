<?php

class Powerbody_Slider_Model_Mysql4_Group_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('powerbody_slider/group');
        parent::_construct();
    }
}