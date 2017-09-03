<?php 
declare(strict_types=1);
use XMLView\View\ResourceView;

/**
 * Display View based on a resources file 
 * 
 * @param string $p_resourceFile XML Resource file 
 * @param array $p_data          Extra /parameter data to view
 */
function XMLView(string $p_resourceFile,Array $p_data=[]):void
{
    $l_view=new ResourceView($p_resourceFile, $p_data);
    $l_view->display();
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
