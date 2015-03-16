<?php
/* -- BEGIN LICENSE BLOCK ----------------------------------
  #
  # This file is part of Categories Page, a plugin for Dotclear 2.
  #
  # Copyright (c) 2013 Pierre Van Glabeke, Bernard Le Roux
  # Licensed under the GPL version 2.0 license.
  # See LICENSE file or
  # http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
  #
  # -- END LICENSE BLOCK ------------------------------------ */
if (!defined('DC_RC_PATH')) {
	return;
}

widgetsCategoriesPage::main();


class widgetsCategoriesPage {
	/*
	 * initialisation du context widget
	*/
	public static function main() {
		require_once __DIR__.'/ConstCategoriesPage.php';
		
		$core = $GLOBALS['core'];

		$core->addBehavior('initWidgets', array('widgetsCategoriesPage', 'initWidgets'));
	}

	// Widget function
	public static function categoriesPageWidgets($widget) {
		$core = $GLOBALS['core'];

		$url = $core->url;

		if ($widget->offline)
			return;
		
		if (($widget->homeonly == 1 && $url->type !== 'default') ||
			($widget->homeonly == 2 && $url->type === 'default')) {
			return;
		}

		$res =
		($widget->title ? $widget->renderTitle(html::escapeHTML($widget->title)) : '').
		'<p><a href="'.$core->blog->url.$core->url->getBase('categories').'">'.
		($widget->link_title ? html::escapeHTML($widget->link_title) : __('All categories')).
		'</a></p>';

		return $widget->renderDiv($widget->content_only,'categories '.$widget->class,'',$res);
	}

	public static function initWidgets($widget) {
		$text = __('Categories Page');
		$widget->create('CategoriesPage', __('CategoriesPage'), array('widgetsCategoriesPage', 'categoriesPageWidgets'),
			null,
			__('Link to categories'));
		$categoriesPage = $widget->CategoriesPage;
		$categoriesPage->setting('title', __('Title:'), $text, 'text');
		$categoriesPage->setting('homeonly', __('Display on:'), 0, 'combo', array(
			__('All pages') => 0,
			__('Home page only') => 1,
			__('Except on home page') => 2
				)
		);
		$categoriesPage->setting('content_only', __('Content only'), 0, 'check');
		$categoriesPage->setting('class', __('CSS class:'), '');
		$categoriesPage->setting('offline',__('Offline'),0,'check');
	}

}
