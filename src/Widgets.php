<?php

declare(strict_types=1);

namespace Dotclear\Plugin\CategoriesPage;

use Dotclear\App;
use Dotclear\Helper\Html\Html;
use Dotclear\Plugin\widgets\WidgetsStack;
use Dotclear\Plugin\widgets\WidgetsElement;

/**
 * @brief       CategoriesPage widgets class.
 * @ingroup     CategoriesPage
 *
 * @author      Pierre Van Glabeke (author)
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class Widgets
{
    public static function initWidgets(WidgetsStack $w): void
    {
        $w
            ->create(
                My::id(),
                My::name(),
                self::parseWidget(...),
                null,
                __('Link to categories')
            )
            ->addTitle(My::name())
            ->addHomeOnly()
            ->addContentOnly()
            ->addClass()
            ->addOffline();
    }

    public static function parseWidget(WidgetsElement $w): string
    {
        if ($w->offline
            || !$w->checkHomeOnly(App::url()->type)
            || !App::blog()->isDefined()
        ) {
            return '';
        }

        return $w->renderDiv(
            (bool) $w->content_only,
            My::id() . ' ' . $w->class,
            '',
            ($w->title ? $w->renderTitle(Html::escapeHTML($w->title)) : '') .
            '<p><a href="' . App::blog()->url() . App::url()->getBase('categories') . '">' .
            ($w->get('link_title') ? Html::escapeHTML($w->get('link_title')) : __('All categories')) .
            '</a></p>'
        );
    }
}
