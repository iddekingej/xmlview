<?php
declare(strict_types=1);
namespace XMLView\Widgets\Menu;

use XMLView\Engine\Data\DataStore;

/**
 * Displays a logout menu item 
 *
 */

class LogoutMenuItem extends MenuItem
{
    function displayContent(DataStore $p_store):void
    {
        $this->theme->menu_LeftMenu->logoutMenu();
    }
}