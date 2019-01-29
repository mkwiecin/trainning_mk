<?php

class Powerbody_Slider_Adminhtml_SliderController extends Mage_Adminhtml_Controller_Action
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
		// 1. Get ID and creating model
		$groupId = $this->getRequest()->getParam('id');
		/* @var Powerbody_Slider_Model_Group $groupModel */
		$groupModel = Mage::getModel('powerbody_slider/group');

		// 2. Initial checking
		if (false === empty($groupId)) {
			$groupModel->load($groupId);
			if (true === empty($groupModel->getId())) {
				$this->getSession()->addError($this->__('This Slides Group no longer exists.'));
				$this->_redirect('*/*/');

				return;
			}
		}
		// 3. Set entered data if was error when we do save
		$data = $this->getSession()->getFormData(true);
		if (false === empty($data)) {
			$groupModel->setData($data);
		}
		// 4. Register model to use later in blocks
		Mage::register('slider_group', $groupModel);
		// 5. Build edit form
		$this->_initAction()
			->renderLayout();
	}

	public function saveAction()
	{
		// check if data sent
		if ($data = $this->getRequest()->getPost()) {
			$groupId = $this->getRequest()->getParam('id');
			/* @var Mage_Core_Model_Date $modelDate */
			$modelDate = Mage::getModel('core/date')->date('Y-m-d');

			if (true === isset($groupId)) {
				$data['id'] = $groupId;
				$data['updated_date'] = $modelDate;
			} else {
				$data['created_date'] = $modelDate;
			}
			/* @var Powerbody_Slider_Model_Group */
			$groupModel = Mage::getModel('powerbody_slider/group')->load($groupId);

			if (true === empty($groupModel->getId()) && false === empty($groupId)) {
				$this->getSession()->addError($this->__('This Slides Group no longer exists.'));
				$this->_redirect('*/*/');

				return;
			}
			// init model and set data
			$groupModel->setData($data);
			// try to save it
			try {
				// save the data
				$groupModel->save();
				// display success message
				$this->getSession()->addSuccess($this->__('The Slides Group has been saved.'));
				// clear previously saved data from session
				$this->getSession()->setFormData(false);

				// check if 'Save and Continue'
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', ['id' => $groupModel->getId()]);

					return;
				}
				// go to grid
				$this->_redirect('*/*/');

				return;
			} catch (Exception $e) {
				// display error message
				$this->getSession()->addError($e->getMessage());
				// save data in session
				$this->getSession()->setFormData($data);
				// redirect to edit form
				$this->_redirect('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);

				return;
			}
		}

		$this->_redirect('*/*/');
	}

	public function deleteAction()
	{
		// check if we know what should be deleted
		if ($groupId = $this->getRequest()->getParam('id')) {
			try {
				// init model and delete
				/* @var Powerbody_Slider_Model_Group $groupModel */
				$groupModel = Mage::getModel('powerbody_slider/group')->load($groupId);
				$name = $groupModel->getName();
				$groupModel->delete();
				// display success message
				$this->getSession()->addSuccess($this->__("The Slides Group '%s' has been deleted.",
					$name));
				// go to grid
				$this->_redirect('*/*/');

				return;

			} catch (Exception $e) {
				// display error message
				$this->getSession()->addError($e->getMessage());
				// go back to edit form
				$this->_redirect('*/*/edit', ['id' => $groupId]);

				return;
			}
		}
		// display error message
		$this->getSession()->addError($this->__('Unable to find a Slides Group to delete.'));
		// go to grid
		$this->_redirect('*/*/');
	}

	protected function _initAction(): Powerbody_Slider_Adminhtml_SliderController
	{
		$this->loadLayout();

		return $this;
	}

	protected function _isAllowed(): bool
	{
		return Mage::getSingleton('admin/session')->isAllowed('cms/sliders/groups');
	}

	protected function getSession(): Mage_Adminhtml_Model_Session
	{
		return Mage::getSingleton('adminhtml/session');
	}
}
