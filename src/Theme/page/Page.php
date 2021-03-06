<?php 
declare(strict_types=1);
namespace XMLView\Theme\Page;

use XMLView\Widgets\Base\ThemeItem;
//TODO move application specific layout to XML VC's
class Page extends ThemeItem
{
    
    function pageHeader($p_title,Array $p_js,Array $p_css)
    {
?>
<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="<?=$this->e(csrf_token())?>">
<title><?=$this->e($p_title)?></title>
<link href="/css/main.css" rel="stylesheet" />
<script type='text/javascript' src='/js/core.js'></script>
<script type='text/javascript' src='/js/main.js'></script>
<?php
foreach($p_css as $l_css){
    ?><link href='<?=$this->e($l_css)?>' rel='stylesheet' /><?php   
}
foreach($p_js as $l_js){
    ?>
    <script type='text/javascript' src='<?=$this->e($l_js)?>'></script>
    <?php    
}
?>
</head>
<body>	
<?php       
    }
    
    function note($p_message)
    {
        ?><div class="page_hint"><?=$this->e($p_message)?></div><?php
    }
    
    
    function pageFooter()
    {
?>
</body>
</html>
<?php      
    }
    
    

}
?>