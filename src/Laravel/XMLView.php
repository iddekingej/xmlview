<?php 

use XMLView\Engine\Gui\XMLResourcePage;
use XMLView\Engine\Data\MapData;

/**
 * Display View based on a resources file 
 * 
 * @param string $p_resourceFile XML Resource file 
 * @param array $p_data          Extra /parameter data to view
 */
function XMLView(string $p_resourceFile,Array $p_data=[]):void
{
    $l_file=new XMLResourcePage();
    $l_file->setResourceFile($p_resourceFile);
    $l_file->setErrors(session("errors"));
    $l_store=new MapData(null,$p_data);
    $l_file->display($l_store);
}