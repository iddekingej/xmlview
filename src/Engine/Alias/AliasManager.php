<?php
declare(strict_types=1);
namespace XMLView\Engine\Alias;


use XMLView\Base\Base;

class AliasManager extends Base
{
    static private $parser=null;
    static private $aliasList=null;
    static private $aliasFiles=[];

    /**
     * Initialize the alias manage
     */
    
    private static function init()
    {
        static::$aliasList=new AliasList();
        static::$parser=new AliasParser(static::$aliasList);
    }
    
    /**
     * By default alias are read from the configuration gui.aliasFiles.
     * Some extra file can be set (for testing for example) by this method.
     * 
     * @param unknown $p_file  Alias file name
     */
    static function addAliasFile($p_file)
    {
        static::$aliasFiles[]=$p_file;
    }
    
    /**
     * Resets the alias list. This is used for testing the alias system.
     * Before each test, the alias must be reset and reread. 
     */
    
    static function resetAliases()
    {
        static::$aliasList=null;
        static::$parser=null;
        static::$aliasFiles=[];
    }
    
    /**
     * Load all alias files.
     * Multiple alias can be loaded. They need to be set by the gui.aliasFiles configuration or with the 
     * a call to addlAliasFiles
     * 
     */
    static function loadAliases()
    {
        static::init();
        $l_aliasFiles=array_merge(config("gui.aliasFiles"),static::$aliasFiles);
        foreach($l_aliasFiles as $l_fileName){
            static::$parser->parse(base_path($l_fileName));
        }
    }
    
    /**
     * Get alias by type and name. 
     * When this method is called the first time, the alias is read and cached for this session,
     * 
     * @param string $p_type Alias type
     * @param string $p_name Alias Name
     * @return string alias value.
     * @throws AliasException  This exception is raised if there is no alias with the given type.

     */
    public static function getAlias(string $p_type,string $p_name):string
    {
        if(static::$aliasList===null){
            static::loadAliases();
        }
        return static::$aliasList->getAlias($p_type,$p_name);
    }
}
