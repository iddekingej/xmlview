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
    private static function canUseCached(string $p_orgName,string $p_cached,string $p_depFile):bool
    {
        if(!file_exists($p_cached)){
            return false;
        }
        $l_orgMTime=filemtime($p_orgName);
        $l_cachedMTime=filemtime($p_cached);
        if($l_orgMTime >$l_cachedMTime){
            return false;
        }
        if(file_exists($p_depFile)){
            $l_deps=require_once($p_depFile);
            foreach($l_deps as $l_dep){
                $l_cache=xmlview_cachePath($l_dep);
                $l_cachedMTime=filemtime($l_cache);
                if($l_orgMTime >$l_cachedMTime){
                    return false;
                }
            }
        }
        return false;
    }
       
    /**
     * Get compiled or cached version GUI layout
     * 
     * @param string $p_source
     * @return bool
     */
    static function getCompiled(string $p_source):string
    {        
        $l_source=xmlview_resourcePath($p_source);
        $l_cached=xmlview_cachePath($p_source);
        $l_depBase=dirname($p_source)."/dep__".basename($p_source);
        $l_dep = xmlview_cachePath($l_depBase);
        if(static::canUseCached($l_source,$l_cached,$l_depBase)){
            return $l_cached;
        }
        $l_parser=new XMLGUIParser();
        $l_code=$l_parser->parseXML($p_source);
        $l_path=dirname($l_cached);
        if(!file_exists($l_path)){
            mkdir($l_path,0777,true);
        }
        $l_usedFiles=$l_parser->getUsedFiles();
        file_put_contents($l_dep,"<?php\n return ".var_export($l_usedFiles,true).";");
        file_put_contents($l_cached,"<?php\n".$l_code,LOCK_EX);
        return $l_cached;
    }
    

}