<?php
declare(strict_types=1);
namespace XMLView\Widgets\Base;

use Illuminate\Support\ViewErrorBag;
use XMLView\Engine\Data\DataStore;
/**
 * HtmlPage object 
 *
 */
abstract class HtmlPage extends HtmlComponent
{
    protected $theme;
    protected $title;
    protected $extraCss=[];
    protected $extraJs=[];
    private $errors;
    
    function __construct()
    {
        $this->theme=new Theme();
    }
    
    
    final function setErrors(?ViewErrorBag $p_errors):void
    {
        $this->errors=$p_errors;
    }
    
    final function getErrors():?ViewErrorBag
    {
        return $this->errors;
    }
    
    /**
     * Get the page to which a component belongs
     *  
     * @return \App\Vc\Lib\HtmlPage 
     */
    function getPage():?HtmlPage
    {
        return $this;
    }
    
    /**
     * Display content of page
     */
    
    
    protected abstract function content(?DataStore $p_store=null):void;

    /**
     * Setup page. This is called before the page HTML is produced
     */
    function setup():void
    {
        
    }
    
    /**
     * This is called after the header, but before content
     * This method should contain that product html before the content
     */
    function preContent(?DataStore $p_store=null):void
    {
        
    }
    
    /**
     * Called after the "content"  content (footer).
     */
    function postContent(?DataStore $p_store=null):void
    {
        
    }
    
    /**
     * Display page
     */
    final function display(DataStore $p_store):void
    {
        $this->setup();
        $this->theme->page_Page->pageHeader($this->title,$this->extraJs,$this->extraCss);
        $this->preContent($p_store);
        $this->content($p_store);
        $this->postContent($p_store);
        $this->theme->page_Page->pageFooter();
    }
}