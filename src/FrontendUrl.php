<?php

declare(strict_types=1);

namespace Dotclear\Plugin\CategoriesPage;

use Dotclear\App;

/**
 * @brief       CategoriesPage frontend URL handler class.
 * @ingroup     CategoriesPage
 *
 * @author      Pierre Van Glabeke (author)
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class FrontendUrl
{
    public static function categories(?string $args): void
    {
        App::url()::serveDocument('categories.html');
        exit;
    }
}
