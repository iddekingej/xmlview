<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Link;

use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\DynamicValue;
use XMLView\Engine\Data\DataStore;
use XMLView\Engine\Data\DynamicStaticValue;

/**
 * Displays a  txt link with an icon in the front.
 * 
 * The url of the link is given by a route name and route parameters.
 *
 */
class TextLink extends Widget
{
    
    private $url;    
    private $text;

    function setUrl(DynamicValue $p_url):void
    {
        $this->url=$p_url;
    }
    
    function getUrl():?DynamicValue
    {
        return $this->url;
    }
    

    /**
     * Set the text displayed in the link.
     * This text is html escaped before displaying.
     * 
     * @param string $p_text Text displayed in the link
     */
    function setText(DynamicValue $p_text):void
    {
        $this->text=$p_text;
    }
    
    /**
     * Get the text displayed in the link.
     * 
     * @return string 
     */
    function getText():?DynamicValue
    {
        return $this->text;
    }
    
    /**
     * Initialize the IconTestLinks component
     * 
     */
    function __construct()
    {
        parent::__construct();        
        $this->setContainerHeight(new DynamicStaticValue("0px"));
    }
    /**
     * Displays link.  
     */
    function displayContent(DataStore $p_store):void
    {        
        $l_url=$this->getAttValue("url",$p_store,"string",true);        
        $l_text=$this->getAttValue("text",$p_store,"string",true);
        $this->theme->textLink($l_url,$l_text);
    }
}