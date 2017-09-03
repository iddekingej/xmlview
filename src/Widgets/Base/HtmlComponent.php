<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Base;



use XMLView\Base\Base;
use XMLView\Engine\Data\DataStore;
use XMLView\Base\Align;
use XMLView\Engine\Data\DataLayer;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DynamicStaticValue;

/**
 * Base class of all HtmlComponents
 *
 *
 */
abstract class HtmlComponent extends Base
{
    /**
     * Variable to access themes
     * @var Theme
     */
    protected $theme;
    
    /**
     * Uniquely identify item for cache
     * 
     * @var string
     */
    protected $cacheTag="";
    
    /**
     * Parent element. This element is a child of the parent.
     * 
     * @var HtmlComponent
     */
    protected $parent;
    /**
     * Name of compontent
     * @var string
     */
    protected $name;
    
    /**
     * Width of sizer container in CSS units
     * @var string     
     */
    protected $containerWidth;
    /**
     * Height of sizer container in CSS units.
     * @var string
     */
    protected $containerHeight;
    /**
     * Alignment of component inside its sizer containt
     * @var string
     */
    protected $containerAlign;
    
    /**
     * Data layer belonging of this component, can be null.
     * 
     * @var DataLayer
     */
    private $dataLayer;
        
    
    /**
     * Set data layer of component
     * @param DataLayer $p_dataLayer
     */
    function setDataLayer(DataLayer $p_dataLayer):void
    {
        $this->dataLayer=$p_dataLayer;
    }
    
    /**      
     * 
     * @return DataLayer|NULL Datalayer of page, when null the component doesn't have datalayer
     */
    function getDataLayer():?DataLayer
    {
        return $this->dataLayer;
    }
    
    function __construct()
    {
        $this->theme=Theme::new();
        $this->setContainerWidth(new DynamicStaticValue("100%"));
        $this->setContainerHeight(new DynamicStaticValue("100%"));
    }
    
    /**
     * Page to which this component belong
     * 
     * @return HtmlPage|NULL Page to which this component belongs or null when component
     *                       doesn't has a page as parent.
     */
    function getPage():?HtmlPage
    {
        if($this->parent){
            return $this->parent->getPage();
        }
        return null;
    }
    
    /**
     * Set the name of form element
     * 
     * @param string $p_name
     */
    function setName(string $p_name):void
    {
        $this->name=$p_name;
    }
  
    /**
     * Get the name of the element
     * 
     * @return String|NULL
     */
    function getName():?String
    {
        return $this->name;
    }
    
    /**
     * Set the parent of this component
     * 
     * @param HtmlComponent $p_parent
     */
    function setParent(HtmlComponent $p_parent)
    {
        
        $this->parent=$p_parent;
    }
    
    /**
     * Get the parent component
     * 
     * @return HtmlComponent|NULL
     */
    
    function getParent():?HtmlComponent
    {
        return $this->parent;
    }
    
    /**
     * Set container (sizer) width.
     * Default is 100%
     * 
     * @param string $p_width Container width is css units
     */
    function setContainerWidth(DynamicValue $p_width):void
    {
        $this->containerWidth=$p_width;
    }
    
    /**
     * Get the container(sizer) width.
     * @return string  Container width in css units
     */
    function getContainerWidth():?DynamicValue
    {
        return $this->containerWidth;
    }
    /**
     * Set container (sizer) height
     * @param string $p_height Container height in css units;
     */
    function setContainerHeight(DynamicValue $p_height):void
    {
        $this->containerHeight=$p_height;
    }
    
    /**
     * Get the container height
     * @return string Get the container height in css units.
     */
    
    function getContainerHeight():?DynamicValue
    {
        return $this->containerHeight;
    }
    /**
     * Set the alignment of the element inside the spacer 
     * @param string $p_align  Alignment:Align::LEFT, Align::RIGHT or Align::CENTER
     */
    function setContainerAlign(DynamicValue $p_align):void
    {        
        $this->containerAlign=$p_align;
    }
    
    /**
     * Get the alignment of the container inside the space
     * 
     * @return string Alignment see the @see Align class constants
     */
    function getContainerAlign():?DynamicValue
    {
        return $this->containerAlign;
    }
    
    function setCacheTag(string $p_param):void
    {
        $this->cacheTag=$p_param;
    }
    
    function getCacheTag():string
    {
        return $this->cacheTag;
    }
    
    /**
     * Get all JS url used by component
     * @return array
     */
    
    function getJs(DataStore $p_store):array
    {
        return [];
    }
    /**
     * Get all css used by component
     * @return array
     */
    function getCss(DataStore $p_store):array
    {
        return [];
    }
    
    /**
     * Display/Generator HTML of component.
     */
    abstract function display(DataStore $p_store):void;
}