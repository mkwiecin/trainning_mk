<?php

class Powerbody_Slider_Adminhtml_ItemController extends Mage_Adminhtml_Controller_Action
{
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
		/* @var Powerbody_Slider_Model_Item $itemModel */
		$itemModel = Mage::getModel('powerbody_slider/item');

		// 2. Initial checking and creating model
		if (false === empty($itemId)) {
			$itemModel->load($itemId);
			if (true === empty($itemModel->getId())) {
				$this->getSession()->addError($this->__('This Slides Item no longer exists.'));
				$this->_redirect('*/*/');

				return;
			}
		}
		// 3. Set entered data if was error when we do save
		$data = $this->getSession()->getFormData(true);

		if (false === empty($data)) {
			$itemModel->setData($data);
		}
		// 4. Register model to use later in blocks
		Mage::register('slider_item', $itemModel);
		// 5. Build edit form
		$this->_initAction()
			->renderLayout();
	}

	public function saveAction()
	{
		$itemId = $this->getRequest()->getParam('id');
		$data = $this->getRequest()->getPost();
		$modelDate = Mage::getModel('core/date')->date('Y-m-d');

		if (true === isset($itemId)) {
			$data['id'] = $itemId;
			$data['updated_date'] = $modelDate;
		} else {
			$data['created_date'] = $modelDate;
		}

		/** @var Powerbody_Slider_Model_Service_Uploader $uploaderService */
		$uploaderService = Mage::getModel('powerbody_slider/service_uploader');
		$uploaderService->saveSlidesItem($itemId, $data);
		$this->_redirect('*/*/');
	}

	public function deleteAction()
	{
		// check if we know what should be deleted
		if ($itemId = $this->getRequest()->getParam('id')) {
			try {
				// init model and delete
				/* @var Powerbody_Slider_Model_Item $itemModel */
				$itemModel = Mage::getModel('powerbody_slider/item')->load($itemId);
				$itemModel->delete();
				// display success message
				$this->getSession()->addSuccess($this->__("The Slide Item has been deleted."));
				// go to grid
				$this->_redirect('*/*/');

				return;
			} catch (Exception $e) {
				// display error message
				$this->getSession()->addError($e->getMessage());
				// go back to edit form
				$this->_redirect('*/*/edit', ['id' => $itemId]);

				return;
			}
		}
		// display error message
		$this->getSession()->addError($this->__('Unable to find a Slide Item to delete.'));
		// go to grid
		$this->_redirect('*/*/');
	}

	protected function _isAllowed(): bool
	{
		return Mage::getSingleton('admin/session')->isAllowed('cms/sliders/items');
	}

	protected function _initAction(): Powerbody_Slider_Adminhtml_ItemController
	{
		$this->loadLayout();

		return $this;
	}

	protected function getSession(): Mage_Adminhtml_Model_Session
	{
		return Mage::getSingleton('adminhtml/session');
	}
}
