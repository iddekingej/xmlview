<?php 

use XMLView\Engine\Data\MapData;
use XMLView\Widgets\Base\XMLResourcePage;
use XMLView\Widgets\Base\WrongWidgetTypeException;
use XMLView\Engine\Gui\PageLoader;

/**
 * Display View based on a resources file 
 * 
 * @param string $p_resourceFile XML Resource file 
 * @param array $p_data          Extra /parameter data to view
 */
function XMLView(string $p_resourceFile,Array $p_data=[]):void
{
    $l_gui=new \stdClass();
    $l_file=PageLoader::getCompiled($p_resourceFile);    
    $l_page=require_once $l_file;
    if(!$l_page instanceof XMLResourcePage){
        throw new WrongWidgetTypeException(XMLResourcePage::class, $l_page);
    }
    $l_page->setGui($l_gui);
    $l_store=new MapData(null,$p_data);
    $l_page->setErrors(session("errors"));
    $l_page->display($l_store);
}