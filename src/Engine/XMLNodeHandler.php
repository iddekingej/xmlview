<?php 
namespace XMLView\Engine;


use XMLView\Engine\Parser\ObjectNode;
use XMLView\Engine\Alias\AliasItem;

/**
 * A XMLNodeHandler converts a XML node to AST node. 
 */
interface XMLNodeHandler 
{
    /**
     * Create a object based on a xml node
     * @param ObjectNode $p_parent   Parent AST.
     * @param \DOMNode $p_node       Dom node to convert
     * @return ObjectNode            Net AST created based on $p_node.
     */
    function createObject(?AliasItem $p_alias,?ObjectNode $p_parent,\DOMNode $p_node):ObjectNode;
    function processAST(?ObjectNode $p_parent,\DOMNode $p_node,ObjectNode $p_ast):void;
    function isAttributeIgnored(string $p_name):bool;
}
