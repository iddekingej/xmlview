<?php
declare(strict_types=1);
namespace XMLView\Engine\Alias;


use XMLView\Base\Base;

class AliasManager extends Base
{
    /**
     * Alias parser used for parsing the alias xml
     * 
     * @var AliasParser
     */
    static private $parser=null;
    /**
     * Aliases are stored in this list
     *   
     * @var AliasList
     */
    static private $aliasList=null;
    
    /**
     * The files that are used for defining aliases are stored in configuration files. 
     * it is also possible to add extra files with addAliasFiles. These files are stored in this
     * object variable.
     * 
     * @var array
     */
    static private $aliasFiles=[];

    /**
     * Initialize the alias manage
     */
    
    private static function init():void
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
    static function addAliasFile($p_file):void
    {
        static::$aliasFiles[]=$p_file;
    }
    
    /**
     * Resets the alias list. This is used for testing the alias system.
     * Before each test, the alias must be reset and reread. 
     */
    
    static function resetAliases():void
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
    static function loadAliases():void
    {
        static::init();
        $l_aliasFiles=array_merge(xmlview_getAliasFiles(),static::$aliasFiles);
        foreach($l_aliasFiles as $l_fileName){
            static::$parser->parse($l_fileName);
        }
    }
    
    /**
     * Checks if alias exists
     * 
     * @param string $p_name Alias name
     * @return bool          True: Alias with this name exists. False: Alias doesn't exists
     */
    public static function hasAlias(string $p_name):bool
    {
        if(static::$aliasList === null){
            static::loadAliases();
        }
        return static::$aliasList->hasAlias($p_name);
    }
    
    /**
     * Get alias by type and name. 
     * When this method is called the first time, the alias is read and cached for this session,
     * 
     * @param string $p_name Alias Name
     * @return AliasItem Information about alias
     * @throws AliasException  This exception is raised if there is no alias with the given type.

     */
    public static function getAlias(string $p_name):AliasItem
    {
        if(static::$aliasList===null){
            static::loadAliases();
        }
        return static::$aliasList->getAlias($p_name);
    }
}
