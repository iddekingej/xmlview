<?php
declare(strict_types=1);
namespace XMLView\Widgets\Base;


use XMLView\Engine\Data\DataStore;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Base\Align;
use XMLView\Base\HtmlClass;
/**
 * Base class of all widgets/components
 * 
 *
 */
abstract class Widget extends HtmlComponent
{

    /**
     * Set the class name of the top element
     */
    private $className;
    /**
     * Determines if the  widget is begin displayed
     * - True Widget is displayed (html is generated)
     * - False Widget is not displayed (no html generated)
     * @var DynamicValue
     */
    private $visible;
    
    /**
     * The attributes of a widget are dynamic, the can contain variables. To make this possible
     * most attributes are of type DynamicData.  A dynamic data can be static, or is a variable or 
     * it is a sequence of variables. This method calculates the real value of the attribute based on 
     * data in p_store . The result is checked if it's the correct type     
     * 
     * @param string $p_name                          Name of the attribute.
     * @param DataStore $p_store                      DataSource used for processing the DynamicData object
     * @param string $p_type                          Type of expected result. When empty string, not value check is done.
     * @param bool $p_mandatory                       When true Attribute must be set. 
     * @throws UnkownAttributeException               Raised when attribute is unknown for this widget
     * @throws EmptyAttributeException                Raised when p_madatory is set , but value is empty
     * @throws InvalidAttributeValueException         Raised when 
     * @return Real value of attribute
     */
    function getAttValue(string $p_name,DataStore $p_store,string $p_type="",bool $p_mandatory=false)
    {
        $l_method="get${p_name}";
        if(!method_exists($this,$l_method)){
            throw new UnkownAttributeException($this,$p_name);
        }
        $l_value=$this->$l_method();
        if($l_value !== null){
            $l_realValue = $l_value->getValue($p_store);
        } else {
            $l_realValue = null;
        }
        if($l_realValue === null){
            if($p_mandatory){
                throw new EmptyAttributeException($this, $p_name);
            }
            return null;
        } else if($p_type){
            if(is_object($l_realValue)){
        
                $l_realType=get_class($l_realValue);
            } else {
                $l_realType=gettype($l_realValue);
            }
            if($l_realType != $p_type){
                throw new InvalidAttributeValueException($this, $p_name,$p_type,$l_realType);
            }
        }
        
        return $l_realValue;
    }
    /**
     * Set visibility flag. This should be a boolean wrapped in a DynamicValue
     * If visible is null or DynamicValue evaluated to true the widget is displayed
     *  
     * @param DynamicValue $p_flag   Indicates if component is displayed
     */
    function setVisible(DynamicValue $p_flag):void
    {
        $this->visible=$p_flag;
    }
    
    function getVisible():?DynamicValue
    {
        return $this->visible;
    }
    
    function evaluateVisibility(DataStore $p_store):bool
    {
        $l_value=$this->getAttValue("visible", $p_store,"boolean",false);
        if($l_value === null){
            return true;
        }
        return $l_value;
    }
    /**
     * Get the class name 
     * @return string
     */
    function getBlockClass(DataStore $p_store):string
    {   
        $l_className=$this->getAttValue("className", $p_store,"string",false);
        $l_align=$this->getAttValue("containerAlign",$p_store,"string",false);
        
        if($l_align==Align::CENTER){
            $l_className .= " ".HtmlClass::BLOCK_CENTER;
        }
        return $l_className;
    }
    
    function setClassName(DynamicValue $p_className):void
    {
        $this->className=$p_className;
    }
    
    function getClassName():?DynamicValue
    {
        return $this->className;
    }
    
    /**
     * Display the content
     * 
     * @param DataStore $p_store
     */
    abstract function displayContent(DataStore $p_store);
    
    
    /**
     * When the component has its own data layer, the new data set is calculated
     * The value is passed to displayContent in which the components is displayed.
     * 
     */
    final function display(DataStore $p_store)
    {
        if($this->getDataLayer()){
            $l_store=$this->getDataLayer()->processData($p_store);
        } else {
            $l_store=$p_store;
        }
        $this->displayContent($l_store);
    }
}