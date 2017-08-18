<?php 
namespace XMLView\Engine;
use XMLView\Engine\Parser\ObjectNode;

/**
 * XML files uses a kind of 'bean' technology. Each node is converted to a object.
 * nested node are child object of parent node
 *
 */
abstract class XMLClassParser
{
    private $handlers;
    private $writer;

    function addHandler($p_nodeName,XMLNodeHandler $p_handler)
    {
        $this->handlers[$p_nodeName]=$p_handler;
    }
    
    /**
     * Attributes of the XML set the attributes of an object except special attributes
     * filtered out by a call to isAttrubuteIgnored
     * 
     * @param XMLNodeHandler $p_handler
     * @param \DOMNode $p_node
     */
    private function parseAttributes(XMLNodeHandler $p_handler,\DOMNode $p_node):Array
    {
        $l_attributes = $p_node->attributes;
        $l_length=$l_attributes->length;
        $l_parameters=[];
        for($l_cnt=0;$l_cnt < $l_length;$l_cnt++){
            $l_node=$l_attributes->item($l_cnt);
            $l_name=$l_node->name;
            if(!$p_handler->isAttributeIgnored($l_name)){
                $l_parameters[$l_name]=$l_node->nodeValue;
            }
        }
        return $l_parameters;
    }
    
    private function createObject(?ObjectNode $p_parent,\DOMNode $p_node):ObjectNode
    {
        $l_name=$p_node->nodeName;
        if(!isset($this->handlers[$l_name])){
            throw new XMLParserException(__("Unknow node ':name'",["name"=>$l_name]),$p_node);
        }
        $l_handler=$this->handlers[$l_name];
        $l_newObject=$l_handler->createObject($p_parent,$p_node);

        $l_newObject->setParameters($this->parseAttributes($l_handler, $p_node));
        if($p_parent !== null){
            $p_parent->addChild($l_newObject);
        }
        $l_child = $p_node->firstChild;
        
        while ($l_child) {
            if ($l_child->nodeType == XML_ELEMENT_NODE){
                $this->createObject($l_newObject,$l_child);
            }
            $l_child=$l_child->nextSibling;
        }
        return $l_newObject;
    }
    
    abstract function setupHandlers();
    abstract function checkTopNode(\DOMNode $p_node):void;
    
    function createWriter()
    {
        return new XMLStatementWriter();
    }
    
    public function parseXML(string $p_file)
    {
        $this->setupHandlers();
        $l_dom = new \DOMDocument();
        if($l_dom->load($p_file)===false){
            throw new XMLParserException(__("Invalid XML"),null);
        }
        $l_element = $l_dom->documentElement;        
        $l_element->normalize();
        $this->checkTopNode($l_element);
        $this->writer=$this->createWriter();
        $l_object=$this->createObject(null,$l_element);
        
        $l_object->compile($this->writer);
        return $this->writer->getCode();
    }
}
