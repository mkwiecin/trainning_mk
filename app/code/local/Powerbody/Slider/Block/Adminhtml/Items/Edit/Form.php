<?php


class Powerbody_Slider_Block_Adminhtml_Items_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form([
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', ['id' => $this->getRequest()->getParam('id')]),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ]);

        $form->setUseContainer(TRUE);
        $this->setForm($form);

        if (Mage::getSingleton('adminhtml/session')->getFormData()) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData();
            Mage::getSingleton('adminhtml/session')->setFormData(NULL);
        } elseif (Mage::registry('slider_item')) {
            $data = Mage::registry('slider_item')->getData();
            $data['bg_image'] = 'slider/' . $data['bg_image'];
        }

        $fieldset = $form->addFieldset('item_form',
            ['legend' => Mage::helper('powerbody_slider')->__('Slide Item information')]);
        $fieldset->addField('title', 'text', [
            'label' => Mage::helper('powerbody_slider')->__('Title'),
            'class' => 'required-entry',
            'required' => TRUE,
            'name' => 'title',
        ]);
        $fieldset->addField('link_url', 'text', [
            'label' => Mage::helper('powerbody_slider')->__('Link url'),
            'required' => FALSE,
            'name' => 'link_url',
        ]);
        $fieldset->addField('bg_image', 'image', [
            'label' => Mage::helper('powerbody_slider')->__('Add New Image'),
            'required' => FALSE,
            'name' => 'bg_image',
        ]);
        $fieldset->addField('group_id', 'select', [
            'label' => Mage::helper('powerbody_slider')->__('Slides Group'),
            'required' => TRUE,
            'name' => 'group_id',
            'values' => $this->getSelectOptions(),
        ]);
        $fieldset->addField('status', 'text', [
            'label' => Mage::helper('powerbody_slider')->__('Status'),
            'required' => FALSE,
            'name' => 'status',
        ]);
        $fieldset->addField('display_from', 'date', [
            'format' => Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'label' => Mage::helper('powerbody_slider')->__('Display From'),
            'required' => FALSE,
            'name' => 'display_from',
        ]);
        $fieldset->addField('display_to', 'date', [
            'format' => Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'label' => Mage::helper('powerbody_slider')->__('Display To'),
            'required' => FALSE,
            'name' => 'display_to',
        ]);
        $fieldset->addField('sort_order', 'text', [
            'label' => Mage::helper('powerbody_slider')->__('Sort Order'),
            'class' => 'required-entry',
            'required' => TRUE,
            'name' => 'sort_order',
        ]);

        $form->setValues($data);

        return parent::_prepareForm();
    }

    private function getSelectOptions(): array
    {
        $selectOptions = ['-1' => 'You can make choice...',];
        $collection = Mage::getModel('powerbody_slider/group')->getCollection();
        foreach ($collection as $model) {
            $id = $model->getData('id');
            $name = $model->getData('name');
            $selectOptions[$id] = $name;
        }

        return $selectOptions;
    }

}