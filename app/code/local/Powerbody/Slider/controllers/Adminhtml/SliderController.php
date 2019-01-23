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
		// 1. Get ID and create model
		$id = $this->getRequest()->getParam('id');
		$model = Mage::getModel('powerbody_slider/group');
		// 2. Initial checking
		if ($id) {
			$model->load($id);
			if (!$model->getId()) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('This Slides Group no longer exists.'));
				$this->_redirect('*/*/');

				return;
			}
		}
		// 3. Set entered data if was error when we do save
		$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}
		// 4. Register model to use later in blocks
		Mage::register('slider_group', $model);
		// 5. Build edit form
		$this->_initAction()
			->renderLayout();
	}

	public function saveAction()
	{
		// check if data sent
		if ($data = $this->getRequest()->getPost()) {
			$id = $this->getRequest()->getParam('id');

			if ($id) {
				$data['id'] = $id;
			}
			$model = Mage::getModel('powerbody_slider/group')->load($id);

			if (!$model->getId() && $id) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('This Slides Group no longer exists.'));
				$this->_redirect('*/*/');

				return;
			}
			// init model and set data
			$model->setData($data);

			// try to save it
			try {
				// save the data
				$model->save();
				// display success message
				Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The Slides Group has been saved.'));
				// clear previously saved data from session
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				// check if 'Save and Continue'
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', ['id' => $model->getId()]);

					return;
				}
				// go to grid
				$this->_redirect('*/*/');

				return;
			} catch (Exception $e) {
				// display error message
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				// save data in session
				Mage::getSingleton('adminhtml/session')->setFormData($data);
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
		if ($id = $this->getRequest()->getParam('id')) {
			try {
				// init model and delete
				$model = Mage::getModel('powerbody_slider/group');
				$model->load($id);
				$name = $model->getName();
				$model->delete();
				// display success message
				Mage::getSingleton('adminhtml/session')->addSuccess($this->__("The Slides Group '%s' has been deleted.",
					$name));
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
		Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find a Slides Group to delete.'));
		// go to grid
		$this->_redirect('*/*/');
	}

	protected function _initAction()
	{
		$this->loadLayout();

		return $this;
	}

	protected function _isAllowed(): bool
	{
		return Mage::getSingleton('admin/session')->isAllowed('cms/sliders/groups');
	}
}
