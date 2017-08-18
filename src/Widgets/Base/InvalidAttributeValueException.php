<?php
declare(strict_types=1);
namespace XMLView\Widgets\Base;


class InvalidAttributeValueException extends \Exception
{
    function __construct(Widget $p_widget, string $p_parameterName,string $p_expected,string $p_found)
    {
        parent::__construct("Attribute ':name' of widget ':class' is of type ':type' but ':expected' found",["name"=>$p_parameterName,"expected"=>$p_expected,"type"=>$p_found,"class"=>get_class($p_widget)]);
    }
}