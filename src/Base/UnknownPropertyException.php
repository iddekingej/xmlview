<?php
declare(strict_types=1);
namespace XMLView\Base;

/**
 * When deriving from the @see Base class, the object is protected for 
 * reading and writing undefined properties.
 * This exception is called when a unknown property is read
 */
class UnknownPropertyException extends \Exception
{
    function __construct($p_class,string $p_variable){
        parent::__construct(__("Unknown property :class",["class"=>get_class($p_class)."::".$p_variable]));
    }
}