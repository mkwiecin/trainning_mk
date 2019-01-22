<?php

class Powerbody_Slider_Block_Adminhtml_Items_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('itemsGrid');
        $this->setDefaultSort('event_date');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(TRUE);
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
        $this->addColumn('id', [
            'header' => Mage::helper('powerbody_slider')->__('Id'),
            'width' => 50,
            'index' => 'id',
            'sortable' => TRUE,
        ]);
        $this->addColumn('bg_image', [
            'header' => Mage::helper('powerbody_slider')->__('Image'),
            'index' => 'bg_image',
            'sortable' => TRUE,
            'type' => 'image',
            'renderer' => 'powerbody_slider/adminhtml_items_renderer_image',
        ]);
        $this->addColumn('group_name', [
            'header' => Mage::helper('powerbody_slider')->__('Group'),
            'index' => 'group_name',
            'sortable' => TRUE,
        ]);
        $this->addColumn('status', [
            'header' => Mage::helper('powerbody_slider')->__('Status'),
            'index' => 'status',
            'sortable' => TRUE,
        ]);
        $this->addColumn('display_from', [
            'header' => Mage::helper('powerbody_slider')->__('Display From'),
            'index' => 'display_from',
            'sortable' => TRUE,
        ]);
        $this->addColumn('display_To', [
            'header' => Mage::helper('powerbody_slider')->__('Display To'),
            'index' => 'display_to',
            'sortable' => TRUE,
        ]);
        $this->addColumn('sort_order', [
            'header' => Mage::helper('powerbody_slider')->__('Sort Order'),
            'index' => 'sort_order',
            'sortable' => TRUE,
        ]);

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }

}