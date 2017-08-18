<?php
namespace XMLView\Engine\Gui;


use XMLView\Base\Base;

class PageLoader extends Base
{
    /**
     * If the cached version exists and the modification time is later than the source
     * the cached version can be used
     * 
     * @param string $p_orgName XML Gui definition file
     * @param string $p_cached  Cache name
     * @return boolean          true: cache can be used
     */
    private static function canUseCached(string $p_orgName,string $p_cached):bool
    {
        if(!file_exists($p_cached)){
            return false;
        }
        $l_orgMTime=filemtime($p_orgName);
        $l_cachedMTime=filemtime($p_cached);
        return $l_orgMTime<= $l_cachedMTime;
    }
       
    /**
     * Get compiled or cached version GUI layout
     * 
     * @param string $p_source
     * @return bool
     */
    static function getCompiled(string $p_source):string
    {
        $l_source=base_path(config("hr.xmlBasePath").$p_source);
        $l_cached=base_path(config("hr.xmlCache").$p_source.".php");
        if(static::canUseCached($l_source,$l_cached)){
            return $l_cached;
        }
        $l_parser=new XMLGUIParser();
        $l_code=$l_parser->parseXML($l_source);
        $l_path=dirname($l_cached);
        if(!file_exists($l_path)){
            mkdir($l_path,0777,true);
        }
        file_put_contents($l_cached,"<?php\n".$l_code,LOCK_EX);
        return $l_cached;
    }
    

}