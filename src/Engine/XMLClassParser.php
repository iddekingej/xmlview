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
    /**
     * When a XML Node has a "file" attribute, a
     * @param ObjectNode $p_parent
     * @param string $p_fileName
     * @param XMLNodeHandler $p_handler
     * @param \DOMNode $p_node
     * @return ObjectNode
     */
    function createByFile(?ObjectNode $p_parent,string $p_fileName, XMLNodeHandler $p_handler,\DOMNode $p_node):ObjectNode
    {
        $l_parser=$this->newParser();
        echo "**[$l_fullFileName]";
        $l_ast=$l_parser->parseXMLToAST($l_fullFileName,$p_parent);
        $p_handler->processAST($p_parent, $p_node, $l_ast);
        return $l_ast;
    }
    /**
     * Create AST Node based on the DOM Node 
     * 
     * @param ObjectNode $p_parent    Parent parent AST Node 
     * @param \DOMNode $p_node        DOM Node to parse 
     * @throws XMLParserException     Raised when errors are detected
     * @return ObjectNode             Resulting AST node.
     */
    private function createObject(?ObjectNode $p_parent,\DOMNode $p_node):ObjectNode
    {
        $l_name=$p_node->nodeName;
        if(!isset($this->handlers[$l_name])){
            throw new XMLParserException(__("Unknow node ':name'",["name"=>$l_name]),$p_node);
        }
        $l_handler=$this->handlers[$l_name];
        $l_file=$p_node->attributes->getNamedItem("file");
        if($l_file){
            $l_newObject=$this->createByFile($p_parent,$l_file->nodeValue,$p_node);   
        } else {
            $l_newObject=$l_handler->createObject($p_parent,$p_node);
        }

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
    abstract function newParser():XMLClassParser;
    
    function createWriter()
    {
        return new XMLStatementWriter();
    }
    
    public function parseXMLToAST(string $p_file,?ObjectNode $p_parent=null)
    {
        $this->setupHandlers();
        $l_dom = new \DOMDocument();
        $l_fullFileName=xmlview_resourcePath($p_file);
        if($l_dom->load($l_fullFileName)===false){
            throw new XMLParserException(__("Invalid XML"),null);
        }
        $l_element = $l_dom->documentElement;
        $l_element->normalize();
        $this->checkTopNode($l_element);
        return $this->createObject($p_parent,$l_element);
    }
    public function parseXML(string $p_file,?ObjectNode $p_parent=null)
    {
        $l_object=$this->parseXMLToAST($p_file,$p_parent);
        $l_writer=$this->createWriter();     
        $l_object->compile($l_writer);
        return $l_writer->getCode();
    }
}
