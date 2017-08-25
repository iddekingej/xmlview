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
    
    private $aliases;
    
    
    /**
     * Add ab alias to the list
     * 
     * @param string $p_type   Type of alias. Only supported at this moment is TYPE_ELEMENT
     * @param string $p_name   Name of the alias 
     * @param string $p_value  Value of the alias.
     */
    
    function addAlias(string $p_type,string $p_name,string $p_value)
    {
        $this->aliases[$p_name]=new AliasItem($p_type,$p_name,$p_value);        
    }

    /**
     * Checks if there is already a alias
     * 
     * @param string $p_name     Name of alias
     * @return boolean           True - alias allready exists
     */
    function hasAlias(string $p_name)
    {        
        return isset($this->aliases[$p_name]);
    }
    
    /**
     * Get the alias by type and name      
     * @param string $p_name   Name of the alias.
     * @throws AliasException  This exception is raise if there is no alias with the given type.
     * @return AliasItem       Returns the alias item
     */
    function getAlias(string $p_name):AliasItem
    {        
        if($this->hasAlias($p_name)){
            return $this->aliases[$p_name];
        }

        throw new AliasException(__("Unkown alias ':name' ",["name"=>$p_name]));     
    }
}