<?php


class Powerbody_Slider_Block_Adminhtml_Items_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        if (Mage::getSingleton('adminhtml/session')->getFormData()) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData();
            Mage::getSingleton('adminhtml/session')->setFormData(null);
        } elseif (Mage::registry('slider_item')) {
            $data = Mage::registry('slider_item')->getData();
        }

        $fieldset = $form->addFieldset('item_form',
            array('legend' => Mage::helper('powerbody_slider')->__('Slide Item information')));
        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('powerbody_slider')->__('Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
        ));
        $fieldset->addField('link_url', 'text', array(
            'label' => Mage::helper('powerbody_slider')->__('Link url'),
            'required' => false,
            'name' => 'link_url',
        ));
        $fieldset->addField('bg_image', 'file', array(
            'label' => Mage::helper('powerbody_slider')->__('Add New Image'),
            'required' => false,
            'name' => 'bg_image',
            'default_value' => 'yttytyy',
            'class' => 'input-file',
            'after_element_html' => $this->_addAfterElementHtml()
        ));
        $fieldset->addField('group_id', 'select', array(
            'label' => Mage::helper('powerbody_slider')->__('Slides Group'),
            'required' => true,
            'name' => 'group_id',
            'values' => $this->getSelectOptions()
        ));
        $fieldset->addField('status', 'text', array(
            'label' => Mage::helper('powerbody_slider')->__('Status'),
            'required' => false,
            'name' => 'status',
        ));
        $fieldset->addField('display_from', 'date', array(
            'format' => Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'label' => Mage::helper('powerbody_slider')->__('Display From'),
            'required' => false,
            'name' => 'display_from',
        ));
        $fieldset->addField('display_to', 'date', array(
            'format' => Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'label' => Mage::helper('powerbody_slider')->__('Display To'),
            'required' => false,
            'name' => 'display_to',
        ));
        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('powerbody_slider')->__('Sort Order'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'sort_order',
        ));

        $form->setValues($data);

        return parent::_prepareForm();
    }

    private function getSelectOptions(): array
    {
        $selectOptions = ['-1' => 'Please Select...',];
        $collection = Mage::getModel('powerbody_slider/group')->getCollection();
        foreach ($collection as $model) {
            $id = $model->getData('id');
            $name = $model->getData('name');
            $selectOptions[$id] = $name;
        }

        return $selectOptions;
    }

    protected function _addAfterElementHtml()
    {
        $itemModel = Mage::registry('slider_item');
        if (null !== $itemModel && false === empty($itemModel->getData('bg_image'))) {
//             Mage::log(Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)
//                 . 'slider/'
//                 . $itemModel->getData('bg_image'));
                 return $this->getLayout()->createBlock('powerbody_slider/adminhtml_items_renderer_image')
                ->setTemplate('slider/adminhtml/item/grid/renderer/image.phtml')
                ->setData('bg_image', Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)
                    . 'slider/'
                    . $itemModel->getData('bg_image'))->toHtml();
        }
        return '';
    }
}