<?php


class Powerbody_Slider_Block_Adminhtml_Groups_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
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
        } elseif (Mage::registry('slider_group')) {
            $data = Mage::registry('slider_group')->getData();
        }

        $fieldset = $form->addFieldset('group_form',
            array('legend' => Mage::helper('powerbody_slider')->__('Slide Group information')));
        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('powerbody_slider')->__('Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'name',
        ));

        $form->setValues($data);

        return parent::_prepareForm();
    }
}