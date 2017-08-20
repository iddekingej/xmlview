<?php
declare(strict_types=1);
namespace XMLView\Widgets\Base;

/**
 * Raised when attribute doesn't exists in component 
 * 
 */

class UnkownAttributeException extends \Exception
{
    /**
     * Setup exception
     * 
     * @param Widget $p_widget   Failure in this component.
     * @param string $p_name     Name of unknown attribute  
     */
    function __construct(Widget $p_widget,string $p_name){
        parent::__construct(__("Unknown attribute ':name' of widget ':class'",["name"=>$p_name,"class"=>get_class($p_widget)]));
    }
}