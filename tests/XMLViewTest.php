<?php
use PHPUnit\Framework\TestCase;
use XMLView\Widgets\Base\Widget;
use XMLView\Engine\Data\MapData;

/**
 * 
 * Test case base class
 *
 */
abstract class XMLViewTest extends TestCase
{
    function getRelativeResourcePath($p_name)
    {
        return "/tests/resources/$p_name";
    }
    
    /**
     * Get test resources (file) path
     * @param string $p_name name of resources (relative to the resource folder)
     * @return string
     */
    function getResourcePath($p_name)
    {
        return __DIR__ . "/resources/$p_name";
    }
    /**
     * Get test resources (file) content
     * @param string $p_name name of resources (relative to the resource folder)
     * @return string
     */
    function getResource($p_name)
    {
        $l_content=file_get_contents($this->getResourcePath($p_name));
        if($l_content===false){
            throw new \Exception("Resource $p_name not found");
        }
        
        return $l_content;
    }
    
    /**
     * Get test resources (file) size
     * @param string $p_name name of resources (relative to the resource folder)
     * @return string
     */
    function getResourceLen($p_name)
    {
        return filesize($this->getResourcePath($p_name));
    }
    
    function displayElement(Widget $p_widget,Array $p_data=[])
    {
        $l_data=new MapData(null,$p_data);
        $p_widget->display($l_data);
    }
}