<?php 
function route($p_route,Array $p_params=[])
{
    return "http://".$p_route."?".http_build_query($p_params);
}
function xmlview_resourcePath($p_path)
{
    return __DIR__."/resources/".$p_path;
}

function xmlview_cachePath($p_source)
{
    return __DIR__."/resources/cache/".$p_source;
}

function xmlview_getAliasFiles()
{
    return ["aliases/base.xml","aliases/form.xml"];
}

function xmlview_getAliasPath($p_path)
{
    return __DIR__."/../src/xml/$p_path";
}

function csrf_token()
{
    return "XXXXXX1234";
}

function __(string $p_text,array $p_params=[]):string
{
    $l_replace=[];
    $l_by=[];
    foreach($p_params as $l_name=>$l_value){
        $l_replace[]=":$l_name";
        $l_by[]=$l_value;
    }
    return str_replace($l_replace,$l_by,$p_text);
}

function xmlview_old($p_name,$p_default){
   return $p_default;
}
?>