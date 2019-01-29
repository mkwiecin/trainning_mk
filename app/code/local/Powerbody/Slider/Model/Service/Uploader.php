<?php

class Powerbody_Slider_Model_Service_Uploader
{
	public function saveSlidesItem(?int $itemId, array $data): void
	{
		/* @var Powerbody_Slider_Model_Item $itemModel */
		$itemModel = Mage::getModel('powerbody_slider/item');
		try {
			if (false === empty($itemId)) {
				$itemModel->load($itemId);
			}
			$image = $this->getImageName();

			if (null !== $image) {
				$image = $this->sanitize($image);
				$data['bg_image'] = $this->uploadImage($image);
			}

			//check if item is edited and delete 'slider/'-part of bg_image path
			if (false === empty($data['bg_image']['value'])) {
				$data['bg_image'] = substr($data['bg_image']['value'], 7);
			}

			$itemModel->addData($data);
			$itemModel->save();
			$success = Mage::helper('powerbody_slider')->__('Slide Item was successfully saved.');
			$this->getSession()->addSuccess($success);
		} catch (Exception $e) {
			$error = Mage::helper('powerbody_slider')->__('Error occurred during data saving.');
			$this->getSession()->addError($error);
			Mage::logException($e);
		}
	}

	protected function getImageName(): ?string
	{
		if (true !== empty($_FILES['bg_image']['name'])) {
			return $_FILES['bg_image']['name'];
		} else {
			return null;
		}
	}

	protected function getSession(): Mage_Adminhtml_Model_Session
	{
		return Mage::getModel('adminhtml/session');
	}

	protected function uploadImage(string $image): string
	{
		/* @var Varien_File_Uploader $uploader */
		$uploader = new Varien_File_Uploader('bg_image');
		$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
		$uploader->save(Mage::getBaseDir('media') . '/slider/', $image);

		return $uploader->getCorrectFileName($image);
	}

	private function sanitize($str = ''): string
	{
		$str = strip_tags($str);
		$str = preg_replace('/[\r\n\t ]+/', ' ', $str);
		$str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
		$str = strtolower($str);
		$str = html_entity_decode($str, ENT_QUOTES, "utf-8");
		$str = htmlentities($str, ENT_QUOTES, "utf-8");
		$str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
		$str = str_replace(' ', '-', $str);
		$str = rawurlencode($str);
		$str = str_replace('%', '-', $str);

		return $str;
	}
}
