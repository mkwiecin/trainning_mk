<?php

class Powerbody_Slider_Block_Adminhtml_Items_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('itemsGrid');
        $this->setDefaultSort('event_date');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('powerbody_slider/item')->getCollection();
        $collection->getSelect()->joinleft(
            ['sg' => 'slider_group'],
            'main_table.group_id = sg.id',
            ['sg.name as group_name']);
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('Id', array(
            'header' => Mage::helper('powerbody_slider')->__('Id'),
            'width' => 50,
            'index' => 'Id',
            'sortable' => true,
        ));
        $this->addColumn('bg_image', array(
            'header' => Mage::helper('powerbody_slider')->__('Image'),
            'index' => 'bg_image',
            'sortable' => true,
            'type'      => 'image',
            'renderer'  => 'powerbody_slider/adminhtml_items_renderer_image'
        ));
        $this->addColumn('group_name', array(
            'header' => Mage::helper('powerbody_slider')->__('Group'),
            'index' => 'group_name',
            'sortable' => true,
        ));
        $this->addColumn('status', array(
            'header' => Mage::helper('powerbody_slider')->__('Status'),
            'index' => 'status',
            'sortable' => true,
        ));
        $this->addColumn('display_from', array(
            'header' => Mage::helper('powerbody_slider')->__('Display From'),
            'index' => 'display_from',
            'sortable' => true,
        ));
        $this->addColumn('display_To', array(
            'header' => Mage::helper('powerbody_slider')->__('Display To'),
            'index' => 'display_to',
            'sortable' => true,
        ));
        $this->addColumn('sort_order', array(
            'header' => Mage::helper('powerbody_slider')->__('Sort Order'),
            'index' => 'sort_order',
            'sortable' => true,
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}