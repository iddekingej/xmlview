<?php 
namespace XMLView\Engine;


use XMLView\Base\Base;
use XMLView\Engine\Parser\ObjectNode;
use XMLView\Engine\Alias\AliasManager;
use XMLView\Engine\Alias\AliasList;
use XMLView\Engine\Alias\AliasItem;

class XMLClassHandler extends Base implements XMLNodeHandler
{
    private $defaultClass;
    private $baseClass;
    private $parentClass;
    private $addMethod;
    private static $nameCnt=0;
    /**
     * 
     * @param string $p_defaultClass
     * @param string $p_baseClass
     * @param string $p_parentClass
     */
    function __construct(?string $p_defaultClass,?string $p_baseClass,?string $p_parentClass,?string $p_addMethod)
    {
        $this->defaultClass=$p_defaultClass;
        $this->baseClass=$p_baseClass;
        $this->parentClass=$p_parentClass;
        $this->addMethod=$p_addMethod;
    }

    /**
     * When is_subclass_of is used  with class name it only checks if the class is a parent class
     * It fails when it is the class
     * 
     * @param string $p_subject
     * @param string $p_isOf
     * @return Bool
     */
    private function checkClass(string $p_subject,string $p_isOf):Bool
    {
        if($p_subject==$p_isOf){
            return true;
        }
        return is_subclass_of($p_subject,$p_isOf);
    }
    
    
    /**
     * Create object from a XML Node
     * @param XMLStatementWriter $p_writer  Write used to generate PHP
     * @param string             $p_parent  Parent class type, used for checking if it has the right type.
     * @param \DOMNode           $p_node    Object is creared based on this node.
     * @param string             $p_method  Method function of parent used for added the new object
     */
    
    function createObject(?AliasItem $p_alias,?ObjectNode $p_parent,\DOMNode $p_node):ObjectNode
    {
        if($p_parent){
            if ($this->parentClass && ! ($this->checkClass($p_parent->getClass(), $this->parentClass))) {
                throw new XMLParserException(__("Parent class is of type ':class' , but doesn't descent of super class ':super'", [
                    "class" => $p_parent->getClass(),
                    "super" => $this->parentClass
                ]), $p_node);
            }
        }
        
        $l_forNode=$p_node->attributes->getNamedItem("for");
        if($l_forNode){
            $l_addMethod=$l_forNode->nodeValue;
        } else {
            $l_addMethod=$this->addMethod;
        }
        
        $l_node=$p_node->attributes->getNamedItem("type");
        if($l_node){
            if($p_alias){
                throw new XMLParserException(__("Type attribute can't be used because node(:node) is a alias",["node"=>$p_node->nodeName]), $p_node);
            }
            $l_class=$l_node->nodeValue;           
        } else if($p_alias){
            $l_class=$p_alias->getClass();
        } else {
        
            if($this->defaultClass){
                $l_class=$this->defaultClass;
            } else {
                throw new XMLParserException(__("No type attribute, but node requires a 'type' attribute"), $p_node);
            }
        }
        if($l_class[0]=="@"){
            $l_alias=AliasManager::getAlias(substr($l_class,1));
            $l_class=$l_alias->getClass();
        }
        $l_nameNode=$p_node->attributes->getNamedItem("name");
        if($l_nameNode){
            $l_name=$l_nameNode->nodeValue;
        } else {
            $l_name="object".static::$nameCnt;
            static::$nameCnt++;            
        }
        if(!class_exists($l_class)){
            throw new XMLParserException(__("Unknown class ':class'",["class"=>$l_class]), $p_node); 
        }
        if($this->baseClass && !($this->checkClass($l_class,$this->baseClass))){
                throw new XMLParserException(__("Object is class ':class' , but doesn't descent from super class ':super' ",["class"=>$l_class,"super"=>$this->baseClass]), $p_node);
        }
        
        return  new ObjectNode($l_name,$l_class,$p_parent,$l_addMethod);
       
    }
    
    function processAST(?ObjectNode $p_parent,\DOMNode $p_node,ObjectNode $p_ast):void
    {
        if($p_parent){
            if ($this->parentClass && ! ($this->checkClass($p_parent->getClass(), $this->parentClass))) {
                throw new XMLParserException(__("Parent class is of type ':class' , but doesn't descent of super class ':super'", [
                    "class" => $p_parent->getClass(),
                    "super" => $this->parentClass
                ]), $p_node);
            }
        }
        $l_class=$p_ast->getClass();
        if($this->baseClass && !($this->checkClass($l_class,$this->baseClass))){
            throw new XMLParserException(__("Object is class ':class' , but doesn't descent from super class ':super' ",["class"=>$l_class,"super"=>$this->baseClass]), $p_node);
        }
    }
    
    
    function isAttributeIgnored(string $p_name):bool
    {
        return ($p_name=="type") ;
    }
}