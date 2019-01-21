<?php

class Powerbody_Slider_Block_Widget_Slider extends Mage_Core_Block_Abstract implements Mage_Widget_Block_Interface
{
    /**
     * Produce and return widget's html output
     *
     * @return string
     */
    public function _toHtml(): string
    {
        $groupId = $this->getData('slider_list');
        if (isset($groupId)) {
            $itemsCollection = Mage::getModel('powerbody_slider/item')->getCollection();
            $itemsCollection->addFieldToFilter('group_id', ['eq' => $groupId]);
            $itemsCollection->addFieldToFilter('display_from', ['lteq' => Mage::getModel('core/date')->date('Y-m-d')]);
            $itemsCollection->addFieldToFilter('display_To', ['gteq' => Mage::getModel('core/date')->date('Y-m-d')]);
            $itemsCollection->setOrder('sort_order', 'asc');
        }
        $bgImages = $itemsCollection->getColumnValues('bg_image');
//var_dump($bgImages);
        return $this->slideShow($bgImages);
    }

    private function slideShow(array $bgImages) : string
    {
        $imgDiv = '';
        $dotSpan = '';
        for ($i = 0; $i < count($bgImages); $i++) {
            $imgDiv .="
            <div class=\"mySlides fade\">
                <div class=\"numbertext\"></div>
                <img src=\"media/slider/" . $bgImages[$i] . "\" style=\"width:100%\">
                <div class=\"text\"></div>
            </div>
            ";

            $dotSpan .= "<span class=\"dot\"></span> ";
        }

        $html = "
<head>
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<style>
* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 300px;
  height: 210px;
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

<div class=\"slideshow-container\">"
            . $imgDiv .
//<div class=\"mySlides fade\">
//  <div class=\"numbertext\"></div>
//  <img src=\"media/slider/images.jpeg\" style=\"width:100%\">
//  <div class=\"text\"></div>
//</div>
//
//<div class=\"mySlides fade\">
//  <div class=\"numbertext\"></div>
//  <img src=\"media/slider/images1.jpeg\" style=\"width:100%\">
//  <div class=\"text\"></div>
//</div>
//
//<div class=\"mySlides fade\">
//  <div class=\"numbertext\"></div>
//  <img src=\"media/slider/images2.jpeg\" style=\"width:100%\">
//  <div class=\"text\"></div>
//</div>
//
//<div class=\"mySlides fade\">
//  <div class=\"numbertext\"></div>
//  <img src=\"media/slider/images3.jpeg\" style=\"width:100%\">
//  <div class=\"text\"></div>
//</div>

            "</div>
<br>

<div style=\"text-align:center\">"
            . $dotSpan .
//  <span class=\"dot\"></span>
//  <span class=\"dot\"></span>
//  <span class=\"dot\"></span>
//  <span class=\"dot\"></span>
            "</div>

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
";

        return $html;
    }

}