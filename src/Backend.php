<?php

declare(strict_types=1);

namespace Dotclear\Plugin\CategoriesPage;

use ArrayObject;
use Dotclear\App;
use Dotclear\Core\Process;
use Dotclear\Helper\Html\Html;

/**
 * @brief       CategoriesPage backend class.
 * @ingroup     CategoriesPage
 *
 * @author      Pierre Van Glabeke (author)
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class Backend extends Process
{
    public static function init(): bool
    {
        return self::status(My::checkContext(My::BACKEND));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        App::behavior()->addBehaviors([
            'adminSimpleMenuAddType' => function (ArrayObject $items): void {
                $items[My::id()] = new ArrayObject([My::name(), false]);
            },
            'adminSimpleMenuBeforeEdit' => function (string $type, string $select, array &$item): void {
                if (My::id() == $type) {
                    $item[0] = My::name();
                    $item[1] = My::name();
                    $item[2] = Html::stripHostURL(App::blog()->url()) . App::url()->getURLFor(My::id());
                }
            },
            'initWidgets' => Widgets::initWidgets(...),
        ]);

        return true;
    }
}
