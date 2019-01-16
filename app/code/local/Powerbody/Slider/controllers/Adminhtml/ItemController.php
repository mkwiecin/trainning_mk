<?php

class Powerbody_Slider_Adminhtml_ItemController extends
    Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed(): bool
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/sliders/items');
    }

    protected function _initAction()
    {
        $this->loadLayout();

        return $this;
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();

        return $this;
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        // 1. Get ID
        $itemId = $this->getRequest()->getParam('id');
        // 2. Initial checking and creating model
        if ($itemId) {
            $model = Mage::getModel('powerbody_slider/item')->load($itemId);
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('powerbody_slider')->__('This Slides Item no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }
        // 3. Set entered data if was error when we do save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(TRUE);
        if (!empty($data)) {
            $model->setData($data);
        }
        // 4. Register model to use later in blocks
        Mage::register('slider_item', $model);
        // 5. Build edit form
        $this->_initAction()
            ->renderLayout();
    }

    public function saveAction()
    {
        $itemId = $this->getRequest()->getParam('id');
        $data = $this->getRequest()->getPost();
        if (isset($itemId)) {
            $data['id'] = $itemId;
        }

        /** @var Powerbody_Slider_Model_Service_Uploader $uploaderService */
        $uploaderService = Mage::getModel('powerbody_slider/service_uploader');
        $uploaderService->saveSlidesItem($itemId, $data);
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                // init model and delete
                $model = Mage::getModel('powerbody_slider/item');
                $model->load($id);
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('powerbody_slider')->__("The Slide Item has been deleted."));
                // go to grid
                $this->_redirect('*/*/');

                return;

            } catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', ['id' => $id]);
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('powerbody_slider')->__('Unable to find a Slide Item to delete.'));
        // go to grid
        $this->_redirect('*/*/');
    }

}