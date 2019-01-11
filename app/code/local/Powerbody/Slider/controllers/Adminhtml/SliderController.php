<?php

class Powerbody_Slider_Adminhtml_SliderController extends
    Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/sliders/groups');
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $group = Mage::getModel('powerbody_slider/group');
        if ($id) {
            $group->load((int)$id);
            if ($group->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $group->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('awesome')->__('The Slider Group does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('slider_group', $group);
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($this->getRequest()->getPost()) {
            try {
                $data = $this->getRequest()->getPost();
                $id = $this->getRequest()->getParam('id');

                if ($data && $id) {
                    $group = Mage::getModel('powerbody_slider/group')->load($id);
                    $group->setData($data);
                    $group->save();
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                }
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('powerbody_slider')->__('An error occurred while saving the group data. Please review the log and try again.')
                );
                Mage::logException($e);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return $this;
            }
        }
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }
}