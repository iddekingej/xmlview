<?php 
declare(strict_types=1);
namespace XMLView\Theme\Base;

use XMLView\Widgets\Base\ThemeItem;

/**
 * Teme items forthe Form component
 *
 */
class Form extends ThemeItem
{
    /**
     * Form header
     * 
     * @param string $p_id Unique dom ID form the form
     * @param string $p_url Submit url of the form
     */
    function formHeader(string $p_id,string $p_url):void
    {
        ?><form class="formForm" id="<?=$this->e($p_id)?>" method="post" action="<?=$this->e($p_url)?>" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?=$this->e(csrf_token())?>" />
        <?php 
    }
    
    /**
     * Hidden form element
     * 
     * @param string $p_name   Name of the hidden element
     * @param string $p_value  Value of the hidden element
     */
    function hidden(string $p_name,string $p_value):void
    {
        ?><input type='hidden' name="<?=$this->e($p_name)?>" value="<?=$this->e($p_value)?>" /><?php 
    }
    
    /**
     * Header of the form content (contains title and table header)
     * @param string $p_title  Title of the form
     */
    function  header(?string $p_title):void
    {
        ?><table class="formTable"><tr><td class="formTitle" colspan='2'><?=$this->e($p_title)?></td></tr><?php 
    }
    
    function rowHeader($p_field,$p_label,$p_error,$p_id)
    {
        ?><tr id="<?=$this->e($p_id)?>"><td class="formLabel">
        	
        	<label for="<?=$this->e($p_field)?>">
        	<?=$this->e($p_label)?>
        	</label>
        	
        	<?php if($p_error){?><div class="formError"><?=$this->e($p_error)?></div><?php }?>        	
        	</td><?php 
    }
    
    function elementHeader()
    {
        ?><td ><?php 
    }
    function rowFooter()
    {
        ?></td></tr><?php 
    }
    
    function submitHeader($p_submitText)
    {
        ?><tr><td colspan='2'><input type='submit' value="<?=$this->e($p_submitText)?>" /><?php 
    }
    
    function submitCancelButton($p_text,$p_js)
    {
       ?><input type='button' value="<?=$this->e($p_text)?>" onclick="<?=$this->e($p_js)?>"/> <?php 
    }
    
    function textElement($p_id,$p_name,$p_value)
    {
        ?><input id="<?=$this->e($p_id)?>" type="text" name="<?=$this->e($p_name)?>" value="<?=$this->e($p_value)?>" style="width:100%"/><?php
    }
    
    function password($p_id,$p_name,$p_value)
    {
        ?><input type="password" name="<?=$this->e($p_name)?>" value="<?=$this->e($p_value)?>" style="width:100%" /><?php
    }
    
    function checkboxElement($p_id,$p_name,$p_checked)
    {
        $l_checked=$p_checked?'checked="1"':"";            
        ?><input id="<?=$this->e($p_id)?>" type="checkbox" name="<?=$this->e($p_name)?>" value="1" <?=$l_checked?> /><?php   
    }
    
    function fileInput($p_id,$p_name)
    {
        ?><input id="<?=$this->e($p_id)?>" type='file' name='<?=$this->e($p_name)?>' /><?php    
    }
    
    function textAreaElement($p_id,$p_name,$p_value,$p_css)
    {
        ?><textarea  id="<?=$this->e($p_id)?>" name="<?=$this->e($p_name)?>" style="<?=$p_css?>"><?=$this->e($p_value)?></textarea><?php
    }
    
    
    function sectionTitle(string $p_title):void
    {
        ?><tr><td colspan=2><div class="formSectionTitle"> <?=$this->e($p_title)?> </div></td></tr><?php    
    }
    function submitFooter()
    {
     ?></td></tr><?php   
    }
    
    
    function footer()
    {
        ?></table><?php    
    }
    
    function formFooter()
    {
        ?></form><?php    
    }
}