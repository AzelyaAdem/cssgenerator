<?php
include "recursive.php";
function my_tableau(){
    $my_image = "NewImage.png";
    if (file_exists($my_image)) { 
        unlink($my_image);
    } 
    $tab  = my_recursive("./");
    foreach($tab as $key => $value) {
        if ($key === 0) {
            $first_img_path = $value;
        }
        if ($key === 1) {
            $second_img_path = $value;
        }
    }
    list($first_width, $first_height) = getimagesize($first_img_path);
    list($second_width, $second_height) = getimagesize($second_img_path);
    $merged_width = $first_width + $second_width;
    $merged_height = $first_height > $second_height ? $first_height : $second_height;
    $merged_image = imagecreatetruecolor($merged_width, $merged_height);
    imagealphablending($merged_image, false);
    imagesavealpha($merged_image, true);
    $first_img = imagecreatefrompng($first_img_path);
    $second_img = imagecreatefrompng($second_img_path);
    imagecopy($merged_image, $first_img,0,0,0,0,$first_width,$first_height);
    imagecopy($merged_image, $second_img,$first_width,0,0,0,$second_width,$second_height);
    if (!file_exists($my_image)){
        imagepng($merged_image, $my_image);
    }
}
my_tableau();