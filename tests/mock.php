<?php 
function route($p_route,Array $p_params=[])
{
    return "http://".$p_route."?".http_build_query($p_params);
}
function xmlview_resourcePath($p_path)
{
    return __DIR__."/resources/".$p_path;
}

function xmlview_viewPath($p_path)
{
    return __DIR__."/resources/".$p_path;
}

function xmlview_cachePath($p_source)
{
    return __DIR__."/resources/cache/".$p_source;
}

function xmlview_viewCachePath($p_source)
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

function session($p_name)
{
    return null;
}

function __(string $p_text,array $p_params=[]):string
{
    preg_match_all("#[\:][a-zA-Z0-9_]+#",$p_text,$l_matches,PREG_SET_ORDER|PREG_OFFSET_CAPTURE);
    $l_prv=0;
    $l_return="";
    if(is_array($l_matches)){
        foreach($l_matches as $l_data){
            $l_name=substr($l_data[0][0],1);
            $l_pos= $l_data[0][1];
            $l_return .= substr($p_text,$l_prv,$l_pos-$l_prv);            
            $l_return .= $p_params[$l_name];
            $l_prv=$l_pos+strlen($l_name)+1;
        }
       $l_return .= substr($p_text,$l_prv);
    }
    return $l_return;
}

function xmlview_old($p_name,$p_default){
   return $p_default;
}
?>