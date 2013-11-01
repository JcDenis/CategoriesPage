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
		require_once 'ConstCategoriesPage.php';
		$core = $GLOBALS['core'];
		$ns = $core->blog->settings->addNamespace(ConstCategoriesPage::NS);
		if (!$ns->get(ConstCategoriesPage::PLUGIN_IS_ACTIVE)) {
			return;
		}

		$core->addBehavior('initWidgets', array('widgetsCategoriesPage', 'initWidgets'));
	}

	// Widget function
	public static function categoriesPageWidgets($widget) {
		$core = $GLOBALS['core'];

		$url = $core->url;
		
		if (($widget->homeonly == 1 && $url->type !== 'default') ||
			($widget->homeonly == 2 && $url->type === 'default')) {
			return;
		}

		$class = $divB = $divE = $title = '';
		if ($widget->class) {
			$class = html::escapeHTML($widget->class);
		}
		if ( $widget->content_only) {
			$divB = '<div class="categories '. $class . '">';
			$divE = '</div>';
		}
		if ( $widget->title ) {
			$title = '<h2>' . html::escapeHTML($widget->title) . '</h2>';
		}
		
		return 	$divB .
				'<ul><li><strong><a href="' . 
				$core->blog->url . $core->url->getBase("categories") . '">' .
				__('All categories') . 
				'</a></strong></li></ul>' .
				$divE;
	}

	public static function initWidgets($widget) {
		$text = __('Categories page');
		$widget->create('CategoriesPage', $text, array('widgetsCategoriesPage', 'categoriesPageWidgets'));
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
	}

}
