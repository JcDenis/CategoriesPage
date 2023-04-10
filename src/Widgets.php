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

use dcCore;
use Dotclear\Helper\Html\Html;
use Dotclear\Plugin\widgets\WidgetsStack;
use Dotclear\Plugin\widgets\WidgetsElement;

class Widgets
{
    public static function initWidgets(WidgetsStack $w): void
    {
        $w
            ->create(
                My::id(),
                My::name(),
                [self::class, 'parseWidget'],
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
        if ($w->offline || !$w->checkHomeOnly(dcCore::app()->url->type)) {
            return '';
        }

        return $w->renderDiv(
            (bool) $w->content_only,
            My::id() . ' ' . $w->class,
            '',
            ($w->title ? $w->renderTitle(Html::escapeHTML($w->title)) : '') .
            '<p><a href="' . dcCore::app()->blog->url . dcCore::app()->url->getBase('categories') . '">' .
            ($w->link_title ? Html::escapeHTML($w->link_title) : __('All categories')) .
            '</a></p>'
        );
    }
}
