<?php

namespace XMLView\Engine\Gui;

use XMLView\Engine\XMLClassParser;
use XMLView\Engine\XMLClassHandler;
use XMLView\Widgets\Base\Widget;
use XMLView\Widgets\Base\GUIFragment;
use XMLView\Widgets\Base\HtmlComponent;
use XMLView\Engine\Data\DataLayer;

class XMLGUIParser extends XMLClassParser
{
    function checkTopNode(\DOMNode $p_node):void
    {
        if($p_node->nodeName != "fragment"){
            throw new XMLParserException("Top node must be a 'page' node");
        }
    }
    
    function setupHandlers()
    {
        $this->addHandler("fragment",new XMLClassHandler(GUIFragment::class, GUIFragment::class, null,""));
        $this->addHandler("element",new XMLClassHandler(null, HtmlComponent::class, Widget::class,"add"));
        $this->addHandler("datalayer",new XMLClassHandler(null,DataLayer::class, Widget::class,"setDataLayer"));
    }
}