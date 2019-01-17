<?php

class Powerbody_Slider_Block_Widget_Slider extends Mage_Core_Block_Abstract implements Mage_Widget_Block_Interface
{
    //    protected function _construct(): string
//    {
//        $groupId = $this->getData('slider_list');
//        /** @var $sliderProvider Advox_Slider_Model_Provider_Slider */
//        $sliderProvider = Mage::getModel('advox_slider/provider_slider');
//        /** @var $sessionModel Mage_Customer_Model_Session */
//        $sessionModel = Mage::getSingleton('customer/session');
//        /** @var $sliderCollection Advox_Slider_Model_Mysql4_Slider_Collection */
//        $sliderCollection = $sliderProvider->getSlidersForGroupByCustomer(
//            $groupId, $sessionModel->getCustomer()
//        );
//
//        if (TRUE === empty($sliderCollection)) {
//            return "";
//        }
//
//        $template = $this->_getTemplatePath($groupId);
//        $this->setData('sliderCollection', $sliderCollection)
//            ->setTemplate($template);
//    }
//
//    protected function _getTemplatePath($groupId): string
//    {
//        $groupModel = Mage::getModel('advox_slider/slider_group')->load($groupId);
//
//        /** @var $groupModel Advox_Slider_Model_Slider_Group */
//        switch ($groupModel->getData('type')) {
//            case Advox_Slider_Model_Slider_Group::MAIN_PAGE_SLIDER:
//                $template = 'slider/widget/slider.phtml';
//                break;
//            case Advox_Slider_Model_Slider_Group::CATEGORY_SLIDER:
//                $template = 'slider/widget/category_slider.phtml';
//                break;
//            case Advox_Slider_Model_Slider_Group::HTML_CONTENT_SLIDER:
//                $template = 'slider/widget/html_content_slider.phtml';
//                break;
//            default:
//                $template = 'slider/widget/slider.phtml';
//                break;
//        }
//
//        return $template;
//    }

    /**
     * Produce and return widget's html output
     *
     * @return string
     */
    public function _toHtml(): string
    {
        $html = "<!DOCTYPE html>
<html>
<head>
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<style>
* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 500px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>
</head>
<body>

<h2>Automatic Slideshow</h2>
<p>Change image every 2 seconds:</p>

<div class=\"slideshow-container\">

<div class=\"mySlides fade\">
  <div class=\"numbertext\">1 / 3</div>
  <img src=\"/var/www/html/trainning_mk/media/slider/images.jpeg\" style=\"width:100%\">
  <div class=\"text\">Caption Text</div>
</div>

<div class=\"mySlides fade\">
  <div class=\"numbertext\">2 / 3</div>
  <img src=\"media/slider/images1.jpeg\" style=\"width:100%\">
  <div class=\"text\">Caption Two</div>
</div>

<div class=\"mySlides fade\">
  <div class=\"numbertext\">3 / 3</div>
  <img src=\"/var/www/html/trainning_mk/media/slider/images2.jpeg\" style=\"width:100%\">
  <div class=\"text\">Caption Three</div>
</div>

</div>
<br>

<div style=\"text-align:center\">
  <span class=\"dot\"></span> 
  <span class=\"dot\"></span> 
  <span class=\"dot\"></span> 
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName(\"mySlides\");
  var dots = document.getElementsByClassName(\"dot\");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = \"none\";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(\" active\", \"\");
  }
  slides[slideIndex-1].style.display = \"block\";  
  dots[slideIndex-1].className += \" active\";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

</body>
</html> ";

        return $html;
    }

    /**
     * Add data to the widget.
     * Retains previous data in the widget.
     *
     * @param array $arr
     * @return Mage_Widget_Block_Interface
     */
    public function addData(array $arr)
    {

    }

    /**
     * Overwrite data in the widget.
     *
     * $key can be string or array.
     * If $key is string, the attribute value will be overwritten by $value.
     * If $key is an array, it will overwrite all the data in the widget.
     *
     * @param string|array $key
     * @param mixed $value
     * @return Varien_Object
     */
    public function setData($key, $value = NULL)
    {

    }

}