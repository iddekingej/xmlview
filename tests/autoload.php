<?php 
function autoload($p_class)
{
    
    $l_baseName="XMLView\\";
    $l_testName="Tests\\";
    if(substr($p_class,0,strlen($l_baseName))==$l_baseName){
        $l_name=substr($p_class,strlen($l_baseName));
        $l_path=__DIR__."/../src/".str_replace("\\","/",$l_name).".php";
        require_once $l_path;
    }  else {

        throw new TestException("Invalid classname $p_class");
    }
}

spl_autoload_register("autoload",true,true);