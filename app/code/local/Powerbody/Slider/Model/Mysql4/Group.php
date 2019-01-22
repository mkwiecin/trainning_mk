<?php

class Powerbody_Slider_Model_Mysql4_Group extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('powerbody_slider/group', 'id');
    }
}
