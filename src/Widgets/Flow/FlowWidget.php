<?php 
declare(strict_types=1);
namespace XMLView\Widgets\Flow;


use XMLView\Widgets\Base\Widget;
use XMLView\Base\SubList;

abstract class FlowWidget extends Widget{
    use SubList
    {
        getJs as protected getJsTrait;
        getCss as protected getCssTrait;
    }
}    