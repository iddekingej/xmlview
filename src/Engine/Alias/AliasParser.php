<?php
declare(strict_types=1);
namespace XMLView\Engine\Alias;

use XMLView\Engine\XMLParserException;
use PhpParser\Node;
use XMLView\Base\Base;
/**
 * This class parses the alias xml files and adds them to a AliasList.
 * 
 */

class AliasParser extends Base{
    
    /**
     * Aliases are added to this list.
     * 
     * @var AliasList
     */
    private $aliasList;
    
    /**
     * Creates the AliasParses and sets the alias list.
     * @param AliasList $p_list Alises are added to this lists
     */
    
    function __construct(AliasList $p_list)
    {
        $this->aliasList=$p_list;
    }
    
    /**
     * Get the attribute  string value
     * 
     * @param \DOMNode $p_node     This method reads the attribute value from this node.
     * @param string $p_name       name of the attribute.
     * @param string $p_default    Default value when attribute is not defined (null by default)
     * @return string|NULL         Value of the attribute.
     */
    private function getAttribute(\DOMNode $p_node,string $p_name,?string $p_default=null):?string
    {
        $l_node=$p_node->attributes->getNamedItem($p_name);
        if($l_node===null){
            return $p_default;
        }
        return $l_node->nodeValue;
    }
    
    
    /**
     * Checks if the node contains invalid attributes
     * When p_node contains attributes not in $p_check an exception is raised.
     * 
     * @param \DOMNode $p_node        Check the attributes of this node.
     * @param array $p_check          The node can only contains attribute in this array.
     * @throws XMLParserException     Exception is raised When object contains attribute that are not in p_check
     */
    private function checkAttributes(\DOMNode $p_node,Array $p_check):void
    {
        $l_attributes=$p_node->attributes;
        for($l_cnt=0;$l_cnt<$l_attributes->length;$l_cnt++){
            $l_node=$l_attributes->item($l_cnt);
            if(!isset($p_check[$l_node->name])){
                throw new XMLParserException(__("Invalid attribute ':attr' at node ':name'",["attr"=>$l_node->name,"name"=>$p_node->nodeName]), $p_node);                
            }
        }
    }
    
    /**
     * Pas the alias node.
     * The node name indicates the node name. The only allowed node name is 'element ' on this moment.
     * The only allowed attributes is name (name of the attribute) and value (value of the attribute).
     * Both are mandatory
     * 
     * @param string $p_base           alias is base+value from node. The base value is set in the parent 'aliases' Node
     *                                 by the base attribute.
     * @param \DOMNode $p_node         Parse this node.
     * @throws XMLParserException      raised when the node have invalid attributes or is missing the 'name' or 'value' attribute.      
     */
    private function parseAlias(string $p_base,\DOMNode $p_node):void
    {
        $l_type=$p_node->nodeName;
        $this->checkAttributes($p_node,["name"=>1,"value"=>1]);
        $l_nameNode=$p_node->attributes->getNamedItem("name");
        if($l_nameNode === null){
            throw new XMLParserException(__("Missing 'name' attribute"), $p_node);
        }
        $l_name=$l_nameNode->nodeValue;            
        $l_valueNode=$p_node->attributes->getNamedItem("value");
        if($l_valueNode === null){
            throw new XMLParserException(__("Missing 'value' attribute"), $p_node);
        }
        
        if($this->aliasList->hasAlias($l_type,$l_name)){
            throw new XMLParserException(__("Duplicate alias :name of type :type",["name"=>$l_name,"type"=>$l_type]),$p_node);
        }
        $this->aliasList->addAlias($l_type, $l_name , $p_base.$l_valueNode->nodeValue);
    }
    
    /**
     * Parses the top node (allways aliases).
     * This node can only contain the 'base' attribute (is not mandatory)
     * This value is added to the front of each child (alias) node.
     * 
     * @param \DOMNode $p_node Node to parse.
     */
    private function parseTopNode(\DOMNode $p_node)
    {
        $this->checkAttributes($p_node,["base"=>1]);
        $l_base=$this->getAttribute($p_node,"base","");
        $l_child=$p_node->firstChild;
        while($l_child){
            if ($l_child->nodeType == XML_ELEMENT_NODE){
                $this->parseAlias($l_base,$l_child);
            }
            $l_child=$l_child->nextSibling;
        }        
    }
    
    /**
     * Setups and parses the XML file to a DomDocument and normalize the nodes.
     * 
     * @param unknown $p_file File to parse.
     * 
     * @throws XMLParserException   When the file contains an invalid alias file
     */
    function parse($p_file):void
    {
        $l_dom = new \DOMDocument();
        $l_file=xmlview_getAliasPath($p_file);
        if($l_dom->load($l_file)===false){
            throw new XMLParserException(__("Invalid XML"),null);
        }
        $l_element = $l_dom->documentElement;
        $l_element->normalize();
        if($l_element->nodeName != "aliases"){
            throw new XMLParserException(__("'alias' expected as top node but :name found",["name"=>$l_element->nodeName]),null,null,$p_file);
        }
        
        try{
            $this->parseTopNode($l_element);
        } catch(XMLParserException $l_e){
            $l_e->setFileName($p_file);
            throw $l_e;
        }
    }
}