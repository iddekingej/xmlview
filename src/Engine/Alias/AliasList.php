<?php
declare(strict_types=1);
namespace XMLView\Engine\Alias;


use XMLView\Base\Base;

/**
 * List of Aliases
 * A alias is uniqly identified by (type,name)
 * 
 *  The only type supported now is TYPE_ELEMENT (used for element types)
 *  Possible type are going to be:
 *  - Element type
 *  - Js files
 *  - Css files
 *  ???
 */

class AliasList extends Base
{
    const TYPE_ELEMENT="element";
    
    private $aliases;
    
    /**
     * Check if the alias type is correct.
     * 
     * @param unknown $p_type   Alias to check.
     * @throws AliasException   Raised when wrong alias is used.
     */
    private function checkAliasType($p_type)
    {
        if($p_type != static::TYPE_ELEMENT){
            throw new AliasException("Invalid alias type ':type'",["type"=>static::TYPE_ELEMENT]);
        }
    }
    
    /**
     * Add ab alias to the list
     * 
     * @param string $p_type   Type of alias. Only supported at this moment is TYPE_ELEMENT
     * @param string $p_name   Name of the alias 
     * @param string $p_value  Value of the alias.
     */
    
    function addAlias(string $p_type,string $p_name,string $p_value)
    {
        $this->checkAliasType($p_type);
        $this->aliases[$p_type][$p_name]=$p_value;
    }

    /**
     * 
     * @param string $p_type
     * @param string $p_name
     * @return boolean|unknown
     */
    function hasAlias(string $p_type,string $p_name)
    {
        $this->checkAliasType($p_type);
        
        if(!isset($this->aliases[$p_type])){
            return false;
        }
        return isset($this->aliases[$p_type][$p_name]);
    }
    
    /**
     * Get the alias by type and name 
     * @param string $p_type   Type of the alias.
     * @param string $p_name   Name of the alias.
     * @throws AliasException  This exception is raise if there is no alias with the given type.
     * @return string          Return the value of the alias if it exists.
     */
    function getAlias(string $p_type,string $p_name):string
    {
        $this->checkAliasType($p_type);
        if($this->hasAlias($p_type,$p_name)){
            return $this->aliases[$p_type][$p_name];
        }
        throw new AliasException(__("Unkown alias ':name' of type ':type'",["type"=>$p_type,"name"=>$p_name]));     
    }
}