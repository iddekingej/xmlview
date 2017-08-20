<?php 
namespace XMLView\Engine;


use XMLView\Engine\Parser\ObjectNode;

interface XMLNodeHandler 
{
    function createObject(?ObjectNode $p_parent,\DOMNode $p_node):ObjectNode;
    function processAST(?ObjectNode $p_parent,\DOMNode $p_node,ObjectNode $p_ast):void;
    function isAttributeIgnored(string $p_name):bool;
}
