<?php

class Powerbody_Slider_Block_Adminhtml_Items_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	const DATE_FORMAT = 'yyyy-MM-dd';

	protected function _prepareForm()
	{
		$form = new Varien_Data_Form([
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/save', ['id' => $this->getRequest()->getParam('id')]),
			'method' => 'post',
			'enctype' => 'multipart/form-data',
		]);

		$form->setUseContainer(true);
		$this->setForm($form);

		if (Mage::getSingleton('adminhtml/session')->getFormData()) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData();
			Mage::getSingleton('adminhtml/session')->setFormData(null);
		} elseif (Mage::registry('slider_item')) {
			$data = Mage::registry('slider_item')->getData();
			$data['bg_image'] = 'slider/' . $data['bg_image'];
		}

		$fieldset = $form->addFieldset('item_form',
			['legend' => $this->__('Slide Item information')]);
		$fieldset->addField('title', 'text', [
			'label' => $this->__('Title'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'title',
		]);
		$fieldset->addField('link_url', 'text', [
			'label' => $this->__('Link url'),
			'required' => false,
			'name' => 'link_url',
		]);
		$fieldset->addField('bg_image', 'image', [
			'label' => $this->__('Add New Image'),
			'required' => false,
			'name' => 'bg_image',
		]);
		$fieldset->addField('group_id', 'select', [
			'label' => $this->__('Slides Group'),
			'required' => true,
			'name' => 'group_id',
			'values' => $this->getSelectOptions(),
		]);
		$fieldset->addField('status', 'text', [
			'label' => $this->__('Status'),
			'required' => false,
			'name' => 'status',
		]);
		$fieldset->addField('display_from', 'date', [
			'format' => self::DATE_FORMAT,
			'label' => $this->__('Display From'),
			'required' => false,
			'name' => 'display_from',
			'image' => $this->getSkinUrl('images/grid-cal.gif'),
		]);
		$fieldset->addField('display_to', 'date', [
			'format' => self::DATE_FORMAT,
			'label' => $this->__('Display To'),
			'required' => false,
			'name' => 'display_to',
			'image' => $this->getSkinUrl('images/grid-cal.gif'),
		]);
		$fieldset->addField('sort_order', 'text', [
			'label' => $this->__('Sort Order'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'sort_order',
		]);

		$form->setValues($data);

		return parent::_prepareForm();
	}

	private function getSelectOptions(): array
	{
		$selectOptions = ['-1' => $this->__('You can make choice...'),];
		$collection = Mage::getModel('powerbody_slider/group')->getCollection();
		foreach ($collection as $model) {
			$id = $model->getData('id');
			$name = $model->getData('name');
			$selectOptions[$id] = $name;
		}

		return $selectOptions;
	}
}
