<?php

namespace XMLView\Engine\Gui;

use XMLView\Engine\XMLClassParser;
use XMLView\Engine\XMLClassHandler;
use XMLView\Widgets\Base\HtmlComponent;
use XMLView\Engine\Data\DataLayer;
use XMLView\Widgets\Base\XMLResourcePage;
use XMLView\Engine\Data\DynamicUrlItem;

class XMLGUIParser extends XMLClassParser
{
    function checkTopNode(\DOMNode $p_node):void
    {

    }
    
    function newParser():XMLClassParser
    {
        return new XMLGUIParser($this->getParseData());
    }
    
    function setupHandlers()
    {        
        $this->addHandler("page",new XMLClassHandler(XMLResourcePage::class, XMLResourcePage::class, null,""));
        $this->addHandler("element",new XMLClassHandler(null, HtmlComponent::class, HtmlComponent::class,"add"));
        $this->addHandler("datalayer",new XMLClassHandler(null,DataLayer::class, HtmlComponent::class,"setDataLayer"));
        $this->addHandler("url", new XMLClassHandler(DynamicUrlItem::class, DynamicUrlItem::class,null,"setUrl"));
    }
}