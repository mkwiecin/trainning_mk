<?php

class Powerbody_Slider_Block_Adminhtml_Groups_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('groupsGrid');
		$this->setDefaultSort('event_date');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}

	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel('powerbody_slider/group')->getCollection();
		$this->setCollection($collection);

		return parent::_prepareCollection();
	}

	protected function _prepareColumns()
	{
		$this->addColumn('id', [
			'header' => $this->__('Id'),
			'width' => 50,
			'index' => 'id',
			'sortable' => false,
		]);
		$this->addColumn('name', [
			'header' => $this->__('Name'),
			'index' => 'name',
			'sortable' => false,
		]);

		return parent::_prepareColumns();
	}
}
