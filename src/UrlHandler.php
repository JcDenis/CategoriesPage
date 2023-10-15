<?php

declare(strict_types=1);

namespace Dotclear\Plugin\CategoriesPage;

use Dotclear\Core\Frontend\Url;

/**
 * @brief       CategoriesPage frontend URL handler class.
 * @ingroup     CategoriesPage
 *
 * @author      Pierre Van Glabeke (author)
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class UrlHandler extends Url
{
    public static function categories(?string $args): void
    {
        self::serveDocument('categories.html');
        exit;
    }
}
