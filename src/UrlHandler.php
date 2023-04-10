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
declare(strict_types=1);

namespace Dotclear\Plugin\CategoriesPage;

use dcUrlHandlers;

class UrlHandler extends dcUrlHandlers
{
    public static function categories(?string $args): void
    {
        self::serveDocument('categories.html');
        exit;
    }
}
