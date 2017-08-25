<?php
declare(strict_types=1);
namespace XMLView\Engine\Alias;


use XMLView\Base\Base;

/**
 * Class to store information about a alias
 * 
 */
class AliasItem extends Base
{
    /**
     * Node type of alias 
     * 
     * @var astring
     */
    private $type;
    
    /**
     * Alias name, must be unique
     * 
     * @var string 
     */
    private $alias;
    
    /**
     * This is a alias for this class
     * 
     * @var string
     */
    private $class;
    
    /**
     * Seets op alias
     * 
     * @param string $p_type   Element type
     * @param string $p_alias  Alias name
     * @param string $p_class  Alias points the this class
     */
    function __construct(string $p_type,string $p_alias,string $p_class)
    {
        $this->type=$p_type;
        $this->alias=$p_alias;
        $this->class=$p_class;
    }
    
    /**
     * Get the type  of the node
     * 
     * @return string
     */
    function getType():string
    {
        return $this->type;
    }
    /**
     * Get the alias name
     * 
     * @return string
     */
    function getAlias():string
    {
        return $this->alias;
    }
    
    /**
     * The alias points to this class
     * 
     * @return string Class name
     */
    function getClass():string
    {
        return $this->class;
    }
}