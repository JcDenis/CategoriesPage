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

dcCore::app()->addBehavior('initWidgets', ['widgetsCategoriesPage', 'initWidgets']);

class widgetsCategoriesPage
{
    public static function initWidgets($w)
    {
        $w
            ->create(
                'CategoriesPage',
                __('Categories Page'),
                ['widgetsCategoriesPage', 'categoriesPageWidgets'],
                null,
                __('Link to categories')
            )
            ->addTitle(__('Categories Page'))
            ->addHomeOnly()
            ->addContentOnly()
            ->addClass()
            ->addOffline();
    }

    public static function categoriesPageWidgets($w)
    {
        if ($w->offline) {
            return;
        }

        if (!$w->checkHomeOnly(dcCore::app()->url->type)) {
            return null;
        }

        return $w->renderDiv(
            $w->content_only,
            'categories ' . $w->class,
            '',
            ($w->title ? $w->renderTitle(html::escapeHTML($w->title)) : '') .
            '<p><a href="' . dcCore::app()->blog->url . dcCore::app()->url->getBase('categories') . '">' .
            ($w->link_title ? html::escapeHTML($w->link_title) : __('All categories')) .
            '</a></p>'
        );
    }
}
