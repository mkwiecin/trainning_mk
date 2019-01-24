<?php

class Powerbody_Slider_Block_Widget_Slider extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('slider/widget/slider.phtml');
    }

    public function getBgImagesOfGroup(): array
    {
        $groupId = $this->getData('slider_list');
        if (true === isset($groupId)) {
        	/* @var Powerbody_Slider_Model_Mysql4_Item_Collection $itemsCollection */
            $itemsCollection = Mage::getModel('powerbody_slider/item')->getCollection();
            $itemsCollection->addFieldToFilter('group_id', ['eq' => $groupId]);
	        /* @var  Mage_Core_Model_Date $dateModel */
	        $dateModel = Mage::getModel('core/date');
            $itemsCollection->addFieldToFilter('display_from', ['lteq' => $dateModel->date('Y-m-d')]);
            $itemsCollection->addFieldToFilter('display_To', ['gteq' => $dateModel->date('Y-m-d')]);
            $itemsCollection->setOrder('sort_order', 'asc');
        }
        $bgImages = $itemsCollection->getColumnValues('bg_image');

        return $bgImages;
    }
}
