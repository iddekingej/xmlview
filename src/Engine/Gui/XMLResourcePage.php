<?php 
namespace XMLView\Engine\Gui;

use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Base\HtmlPage;

/**
 * HTML page that uses XML gui resources
 * 
 *
 */
class XMLResourcePage extends HtmlPage
{
    /**
     * Name of the XML file used as gui layout
     * @var string
     */
    private $resourceFile;
    
    /**
     * Container for all gui widgets 
     * 
     * @var HtmlCompontent
     */
    protected $gui;
    function __construct()
    {
        $this->gui=new \stdClass();
        parent::__construct();
    }
    
    
    
    function setResourceFile(string $p_resourceFile):void
    {
        $this->resourceFile=$p_resourceFile;        
    }
    /**
     * Get the resource file used in the page
     * @return string
     */
    function getResourceFile():string
    {
        return $this->resourceFile;
    }
    

    function makeData(?DataStore $p_data)
    {
        return $p_data;
    }
    
    /**
     * Display the page.
     * 
     * Get the compiled php file from the resource file and executes the 
     * script
     * Because testing is done not in a HtmlPage object, "l_parent" and "this"  is used for setting
     * the parent object of the top
     * 
    
     */
    function content(?DataStore $p_store=null):void
    {
        $l_store=$this->makeData($p_store);
        $l_file=PageLoader::getCompiled($this->resourceFile);
        $l_parent=$this;
        $l_gui=require_once $l_file;
        $l_gui->display($l_store);
    }
    
    function newItem($p_object)
    {
        
    }
    
    function endItem()
    {
        
    }
    
}