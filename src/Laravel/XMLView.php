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
/**
 * Temporary fix for removing Laravel specific code from core to a Laravel interface 
 */
function xmlview_resourcePath($p_path)
{
    return base_path(config("hr.xmlBasePath").$p_path);
}

function xmlview_cachePath($p_source)
{
    return  base_path(config("hr.xmlCache").$p_source.".php");
}

function xmlview_getAliasFiles()
{
    return config("gui.aliasFiles");
}


function xmlview_getAliasPath($p_path)
{
    return base_path(config("hr.xmlBasePath").$p_path);
}

function xmlview_old($p_name,$p_default)
{
    return old($p_name,$p_default);
}
