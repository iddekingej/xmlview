<?php 
namespace XMLView\Widgets\Base;

use XMLView\Widgets\Base\HtmlPage;

/**
 * HTML page that uses XML gui resources
 * 
 *
 */
class XMLResourcePage extends HtmlPage
{
    
    /**
     * Container for all gui widgets 
     * 
     * @var HtmlCompontent
     */
    protected $gui;
   
    function getGui()
    {
        return $this->gui;
    }
    
    function setGui(\stdClass $p_gui):void
    {
        $this->gui=$p_gui;
    }
    
    function content():void
    {
        
    }
}