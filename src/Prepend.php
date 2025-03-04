<?php

declare(strict_types=1);

namespace Dotclear\Plugin\CategoriesPage;

use Dotclear\App;
use Dotclear\Core\Process;

/**
 * @brief       CategoriesPage prepend class.
 * @ingroup     CategoriesPage
 *
 * @author      Pierre Van Glabeke (author)
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class Prepend extends Process
{
    public static function init(): bool
    {
        return self::status(My::checkContext(My::PREPEND));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        App::url()->register(
            My::id(),
            'categories',
            '^categories$',
            FrontendUrl::categories(...)
        );

        return true;
    }
}
