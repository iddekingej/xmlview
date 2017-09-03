<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Base;

use XMLView\Widgets\Base\HtmlPage;

/**
 * HTML page that can be used in XML GUI resources
 
 */
class XMLResourcePage extends HtmlPage
{
    
    /**
     * Container for all gui widgets 
     * 
     * @var HtmlCompontent
     */
    protected $gui;
   
    /**
     * Get the GUI container 
     * @return 
     */
    function getGui()
    {
        return $this->gui;
    }
    
    /** 
     * set the GUI container
     * @param \stdClass $p_gui
     */
    function setGui(\stdClass $p_gui):void
    {
        $this->gui=$p_gui;
    }
    
    function content():void
    {
        
    }
}