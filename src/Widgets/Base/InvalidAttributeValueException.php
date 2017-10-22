<?php
declare(strict_types=1);
namespace XMLView\Widgets\Base;

/**
 * Raised when attribute of a component has a wrong type
 *
 */
class InvalidAttributeValueException extends \Exception
{
    /**
     * Setup exception
     * 
     * @param Widget $p_widget          Exception is raised for this component
     * @param string $p_parameterName   Name of attribute that failed
     * @param string $p_expected        Expected type
     * @param string $p_found           Value of attribute that failed
     */
    function __construct(Widget $p_widget, string $p_parameterName,string $p_expected,string $p_found)
    {
        parent::__construct(__("Attribute ':name' of widget ':class' is of type ':type' but ':expected' expected",["name"=>$p_parameterName,"expected"=>$p_expected,"type"=>$p_found,"class"=>get_class($p_widget)]));
    }
}