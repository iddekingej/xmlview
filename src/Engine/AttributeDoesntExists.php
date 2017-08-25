<?php 
declare(strict_types=1);
namespace XMLView\Engine;

/**
 * This is raised when an attribute is used in a XML definition, but the 
 * class doesn't have this attribute
 *
 */
class AttributeDoesntExists extends XMLParserException
{
    function __construct(string $p_class,string $p_attribute,\DOMNode $p_node)
    {
        parent::__construct(__("Attribute ':attribute' doesn't exists in ':class",["class"=>$p_class,"attribute"=>$p_attribute]),$p_node);
    }
}