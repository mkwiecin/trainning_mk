<?php

class Powerbody_Slider_Block_Adminhtml_Items_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	const DATE_FORMAT = 'yyyy/MM/dd';

	public function __construct()
	{
		parent::__construct();
		$this->setId('itemsGrid');
		$this->setDefaultSort('event_date');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}

	public function getRowUrl($row): string
	{
		return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
	}

	protected function _prepareCollection()
	{
		/* @var Powerbody_Slider_Model_Mysql4_Item_Collection $collection */
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
			'header' => $this->__('Id'),
			'width' => 50,
			'index' => 'id',
			'sortable' => true,
		]);
		$this->addColumn('bg_image', [
			'align' => 'center',
			'header' => $this->__('Image'),
			'index' => 'bg_image',
			'sortable' => true,
			'type' => 'image',
			'renderer' => 'powerbody_slider/adminhtml_items_renderer_image',
			'width' => '110px',
		]);
		$this->addColumn('group_name', [
			'header' => $this->__('Group'),
			'index' => 'group_name',
			'sortable' => true,
		]);
		$this->addColumn('status', [
			'header' => $this->__('Status'),
			'index' => 'status',
			'sortable' => true,
		]);
		$this->addColumn('display_from', [
			'align' => 'center',
			'header' => $this->__('Display From'),
			'index' => 'display_from',
			'sortable' => true,
			'type' => 'date',
			'format' => self::DATE_FORMAT,
		]);
		$this->addColumn('display_To', [
			'align' => 'center',
			'header' => $this->__('Display To'),
			'index' => 'display_to',
			'sortable' => true,
			'type' => 'date',
			'format' => self::DATE_FORMAT,
		]);
		$this->addColumn('sort_order', [
			'header' => $this->__('Sort Order'),
			'index' => 'sort_order',
			'sortable' => true,
		]);

		return parent::_prepareColumns();
	}
}
