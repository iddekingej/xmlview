<?php 
declare(strict_types=1);
namespace XMLView\View;

use XMLView\Base\Base;
use XMLView\Engine\Gui\PageLoader;
use XMLView\Widgets\Base\XMLResourcePage;
use XMLView\Widgets\Base\WrongWidgetTypeException;
use XMLView\Engine\Data\MapData;

/**
 * View for displaying a GUI XML resource file
 * 
 */
class ResourceView extends Base
{
    /**
     * Filename of the GUI XML file 
     * @var string
     */
    private $fileName;
    
    /**
     * Top data used in form
     * @var array
     */
    private $data;
    
    /**
     * Initialize view
     * 
     * @param string $p_fileName  GUI XML Resource file (relative to the configured base path) 
     * @param array $p_data       Data/Parameters used in GUI file
     */
    function __construct(string $p_fileName,Array $p_data=[])
    {
        $this->fileName=$p_fileName;
        $this->data=$p_data;
    }
    
    /**
     * Output/Generate the HTML of the view.
     * The output is written to stdout
     * 
     * @throws WrongWidgetTypeException
     */
    function display():void
    {
        $l_gui=new \stdClass();
        $l_file=PageLoader::getCompiled($this->fileName);        
        $l_page=require $l_file;
        if(!$l_page instanceof XMLResourcePage){
            throw new WrongWidgetTypeException(XMLResourcePage::class, $l_page,"[",$l_file,"]");
        }
        $l_page->setGui($l_gui);
        $l_store=new MapData(null,$this->data);
        $l_page->setErrors(session("errors"));
        $l_page->display($l_store);
    }
    
    /**
     * Get the output of the view as a string
     * 
     * @return string
     */
    function getContent():string
    {
        
        ob_start();
        $this->display();
        $l_content=ob_get_contents();
        ob_clean();        
        return $l_content;
        
    }
    /**
     * When a exception occurs, __toString() returns a error page.
     * this is necessary because in __toString exception are allways fatal. 
     * @param \Throwable $p_e
     * @return string
     */
    private function handleError(\Throwable $p_e):string
    {
        $l_return="<pre>".htmlspecialchars(((string)$p_e)." at ".$p_e->getFile()." at ".$p_e->getLine())."<br/>Trace:<br/></pre>";        
        return "<html><body>$l_return</body></html>";
    }
    
    /**
     * Return output as a string
     * 
     * @return string
     */
    function __toString()
    {
        try{
            return $this->getContent();
        }catch(\Throwable $l_e){
           return $this->handleError($l_e);
        }
    }
}