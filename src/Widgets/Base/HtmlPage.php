<?php
declare(strict_types=1);
namespace XMLView\Widgets\Base;

use Illuminate\Support\ViewErrorBag;
use XMLView\Engine\Data\DataStore;
use XMLView\Widgets\Sizer\VerticalSizer;
use XMLView\Base\SubSizer;
use XMLView\Engine\Data\DynamicValue;
/**
 * HtmlPage object 
 *
 */
abstract class HtmlPage extends HtmlComponent
{
    use SubSizer;
    protected $theme;
    protected $title;
    protected $extraCss=[];
    protected $extraJs=[];

    private $errors;
    
    
    function __construct()
    {
        $this->theme=new Theme();
        $this->setTop(new VerticalSizer());
    }

    
    /**
     * Set the title of the page.
     * This value set's the <title> tag of the page
     * 
     * @param DynamicValue $p_title  String wrapped in a DynamicValue object
     */
    function setTitle(DynamicValue $p_title)
    {
        $this->title=$p_title;
    }
    
    
    function getTitle():?DynamicValue
    {
        return $this->title;
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
    
    
    protected abstract function content():void;

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
    function preContent(DataStore $p_store):void
    {
        
    }
    
    /**
     * Called after the "content"  content (footer).
     */
    function postContent(DataStore $p_store):void
    {
        
    }
    
    /**
     * This is a temporary fix  and can be removed if all templates are moved to XML
     * In this method application specific html is generated
     */
    function themeHeader()
    {
        
    }
    
    /**
     * Display page
     */
    final function display(DataStore $p_store):void
    {

        $this->setup();
        $this->content();
        if($this->getDataLayer()){
            $l_store=$this->getDataLayer()->processData($p_store);
        } else {
            $l_store=$p_store;
        }
        if($this->title){
            $l_title=$this->title->getValue($l_store);
        } else {
            $l_title="";
        }

        $l_js=array_unique(array_merge($this->getJs($l_store),$this->extraJs));
        $l_css=array_unique(array_merge($this->getCss($l_store),$this->extraCss));
        $this->theme->page_Page->pageHeader($l_title,$l_js,$l_css);
        $this->preContent($l_store);
        $this->themeHeader();
        $this->top->display($l_store);
        $this->postContent($l_store);
        $this->theme->page_Page->pageFooter();
    }
    
}