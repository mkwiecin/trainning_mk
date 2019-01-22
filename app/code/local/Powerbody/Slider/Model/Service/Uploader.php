<?php

class Powerbody_Slider_Model_Service_Uploader
{
    /**
     * @param int $sliderId
     * @param array $data
     */
    public function saveSlidesItem($itemId, $data)
    {
        $itemModel = Mage::getModel('powerbody_slider/item');
        try {
            if (false === empty($itemId)) {
                $itemModel->load($itemId);
            }

            $image = $this->_getImageName();
            if (false !== $image) {
                $image = $this->sanitize($image);
                $data['bg_image'] = $this->_uploadImage($image);
            }
            $itemModel->addData($data);
            $itemModel->save();
            $success = Mage::helper('powerbody_slider')->__('Slide Item was successfully saved.');
            $this->_getSession()->addSuccess($success);
        } catch (Exception $e) {
            $error = Mage::helper('powerbody_slider')->__('Error occurred during data saving.');
            $this->_getSession()->addError($error);
            Mage::logException($e);
        }
    }

    protected function _getImageName()
    {
        if (true !== empty($_FILES['bg_image']['name'])) {
            return $_FILES['bg_image']['name'];
        } else {
            return false;
        }
    }

    protected function _getSession()
    {
        return Mage::getModel('adminhtml/session');
    }

    protected function _uploadImage($image)
    {
        /* @var $uploader Varien_File_Uploader */
        $uploader = new Varien_File_Uploader('bg_image');
        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
        $uploader->save(Mage::getBaseDir('media') . '/slider/', $image);

        return $uploader->getCorrectFileName($image);
    }

    private function sanitize($str = '') : string
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
