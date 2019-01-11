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
        $groupId = $this->getRequest()->getParam('id');

        if (null !== $groupId) {
            $groupModel = Mage::getModel('powerbody_slider/group')->load($groupId);

            if (null !== $groupModel->getId()) {
                Mage::register('slider_group', $groupModel);
            } else {
                $this->_getSession()->addError($this->__('Slider Group not found'));
                $this->_redirect('*/*/index');

                return;
            }
        }

        $this->loadLayout();
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