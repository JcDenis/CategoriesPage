<?php
/**
 * @brief CategoriesPage, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugin
 *
 * @author Pierre Van Glabeke, Bernard Le Roux and Contributors
 *
 * @copyright Jean-Christian Denis
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
if (!defined('DC_RC_PATH')) {
    return null;
}

dcCore::app()->url->register('categories', 'categories', '^categories$', ['urlCategoriesPage', 'categories']);

class urlCategoriesPage extends dcUrlHandlers
{
    public static function categories($args)
    {
        self::serveDocument('categories.html');
        exit;
    }
}
