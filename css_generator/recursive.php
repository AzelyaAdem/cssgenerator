<?php
function my_recursive($dir, $tab = array())
{
    $handle = opendir($dir);
    
        while (false !== ($entry = readdir($handle))) { 
            if ($entry != "." && $entry != "..") {
                $path = $dir ."/". $entry;
            if (is_dir($path)) {
               $tab = my_recursive($path, $tab); 
            }
            if (preg_match("/.png$/", $path) === 1) {
                array_push($tab, $path);
            }
        }
    }
    closedir($handle);
    return $tab;
}