<?php
declare(strict_types=1);
namespace XMLView\Widgets\Base;

/**
 * Raised when attribute on component is mandatory, but value not set.
 *
 */
class EmptyAttributeException extends \Exception
{
    /**
     * Create object and set error message 
     * 
     * @param Widget $p_widget   Attribute of Component was not set 
     * @param string $p_name     Error is raised for not setting this attribute
     */
    function __construct(Widget $p_widget,string $p_name){
        parent::__construct(__("Mandatory attribute ':name' of widget ':class' is null or not set",["name"=>$p_name,"class"=>get_class($p_widget)]));
    }
}