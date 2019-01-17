<?php

class Powerbody_Slider_Model_Group extends Mage_Core_Model_Abstract
{
    public function __construct()
    {
        $this->_init('powerbody_slider/group');
        parent::_construct();
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $groupCollection = Mage::getModel('powerbody_slider/group')->getCollection();
        if (TRUE === empty($groupCollection)) {

            return $selectOptions = [];
        }
        foreach ($groupCollection as $groupModel) {
            $selectOptions[] = [
                'label' => $groupModel->getData('name'),
                'value' => $groupModel->getData('id'),
            ];
        }
        return $selectOptions;

    }

}