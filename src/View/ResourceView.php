<?php 
namespace XMLView\View;

use XMLView\Base\Base;
use XMLView\Engine\Gui\PageLoader;
use XMLView\Widgets\Base\XMLResourcePage;
use XMLView\Widgets\Base\WrongWidgetTypeException;
use XMLView\Engine\Data\MapData;

class ResourceView extends Base
{
    private $fileName;
    private $data;
    
    function __construct(string $p_fileName,Array $p_data=[])
    {
        $this->fileName=$p_fileName;
        $this->data=$p_data;
    }
    
    function display():void
    {
        $l_gui=new \stdClass();
        $l_file=PageLoader::getCompiled($this->fileName);
        $l_page=require_once $l_file;
        if(!$l_page instanceof XMLResourcePage){
            throw new WrongWidgetTypeException(XMLResourcePage::class, $l_page);
        }
        $l_page->setGui($l_gui);
        $l_store=new MapData(null,$this->data);
        $l_page->setErrors(session("errors"));
        $l_page->display($l_store);
    }
    
    function getContent()
    {
        
        ob_start();
        $this->display();
        $l_content=ob_get_contents();
        ob_clean();        
        return $l_content;
        
    }
    
    function handleError(\Throwable $p_e){
        $l_return="<pre>".htmlspecialchars(((string)$p_e)." at ".$p_e->getFile()." at ".$p_e->getLine())."<br/>Trace:<br/></pre>";        
        return "<html><body>$l_return</body></html>";
    }
    
    function __toString()
    {
        try{
            return $this->getContent();
        }catch(\Throwable $l_e){
           return $this->handleError($l_e);
        }
    }
}