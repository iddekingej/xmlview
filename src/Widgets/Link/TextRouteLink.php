<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Link;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DataStore;
use XMLView\Engine\Data\DynamicValue;

/**
 * A component that displays a link, with route base url
 *
 */
class TextRouteLink extends Widget
{
    /**
     * Route used in URL
     * @var DynamicValue
     */
    private $route;
    /**
     * Parameters used in url
     * @var DynamicValue
     */
    private $parameters;
    /**
     * Text displayed in URL
     * @var DynamicValue
     */
    private $text;
    
    /**
     * Setup object
     * @param string $p_route
     * @param array $p_data
     * @param string $p_text
     */
   
    /**
     * This is the name of the route used in the link
     * This parameter is mandatory.
     * This parameter must be a string wrapped in a DynamicValue
     * 
     * @param DynamicValue $p_route
     */
    function setRoute(DynamicValue $p_route):void
    {
        $this->route=$p_route;
    }
    
    /**
     * Get the name of the route used in the link 
     * @return DynamicValue|NULL Route name
     */
    function getRoute():?DynamicValue
    {
        return $this->route;
    }
    
    /**
     * Get the parameter part of the route
     * This must be null or a array wrapped in a DynamicValue
     * 
     * @param DynamicValue $p_parameters Parameters of route
     */
    function setParameters(DynamicValue $p_parameters):void
    {
        $this->parameters=$p_parameters;
    }
    
    /**
     * Get the parameter part of the url
     * 
     * @return DynamicValue|NULL
     */
    function getParameters():?DynamicValue
    {
        return $this->parameters;
    }
    
    /**
     * 
     * @param DynamicValue $p_text
     */
    function setText(DynamicValue $p_text):void
    {
        $this->text=$p_text;
    }
    
    function getText():?DynamicValue
    {
        return $this->text;
    }
    
    /**
     * Displayes link
     * 
     * {@inheritDoc}
     * @see \App\Vc\Lib\HtmlComponent::display()
     */
    function displayContent(DataStore $p_store):void
    {
        $l_route=$this->getAttValue("route", $p_store,"string",true);
        $l_parameters=$this->getAttValue("parameters",$p_store,"array",false);
        $l_text=$this->getAttValue("text",$p_store,"",true);
        $this->theme->textRouteLink($l_route,$l_parameters,$l_text);
    }
}