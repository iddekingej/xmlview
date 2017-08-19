<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Base;



use XMLView\Base\Base;
use XMLView\Engine\Data\DataStore;
use XMLView\Base\Align;
use XMLView\Engine\Data\DataLayer;

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
    protected $name;
    
    protected $containerWidth="100%";
    protected $containerHeight="100%";
    protected $containerAlign=Align::LEFT;
    private $dataLayer;
    
    function setDataLayer(DataLayer $p_dataLayer)
    {
        $this->dataLayer=$p_dataLayer;
    }
    
    function getDataLayer():?DataLayer
    {
        return $this->dataLayer;
    }
    
    function __construct()
    {
        $this->theme=Theme::new();
    }
    
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
    
    function setParent(HtmlComponent $p_parent)
    {
        
        $this->parent=$p_parent;
    }
    
    
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
    function setContainerWidth(string $p_width):void
    {
        $this->containerWidth=$p_width;
    }
    
    /**
     * Get the container(sizer) width.
     * @return string  Container width in css units
     */
    function getContainerWidth():string
    {
        return $this->containerWidth;
    }
    /**
     * Set container (sizer) height
     * @param string $p_height Container height in css units;
     */
    function setContainerHeight(string $p_height):void
    {
        $this->containerHeight=$p_height;
    }
    
    /**
     * Get the container height
     * @return string Get the container height in css units.
     */
    
    function getContainerHeight():string
    {
        return $this->containerHeight;
    }
    /**
     * Set the alignment of the element inside the spacer 
     * @param string $p_align  Alignment:Align::LEFT, Align::RIGHT or Align::CENTER
     */
    function setContainerAlign(string $p_align)
    {
        Align::validate($p_align);
        $this->containerAlign=$p_align;
    }
    
    /**
     * Get the alignment of the container inside the space
     * 
     * @return string Alignment see the @see Align class constants
     */
    function getContainerAlign():string
    {
        return $this->containerAlign;
    }
    
    function setCacheTag(string $p_param){
        $this->cacheTag=$p_param;
    }
    
    function getCacheTag()
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
    abstract function display(DataStore $p_store);
}