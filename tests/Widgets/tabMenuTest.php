<?php 

use XMLView\Engine\Data\MapData;
use XMLView\View\ResourceView;

class tabMenuTest extends XMLViewTest
{
    //If current tag not set: following error  shouldn't occur
    //TypeError: Return value of XMLView\Widgets\Menu\TabMenu::getCurrentTag() must implement interface XMLView\Engine\Data\DynamicValue, null returned
    
    function testNoCurrent()
    {
        $l_page=new ResourceView("xml/tabmenu/tm1.xml");        
        $l_store=new MapData(null);
        $l_page->display($l_store);
        $this->assertTrue(true);
    }
}

?>