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

publicCategoriesPage::main();

class publicCategoriesPage {

	public static function main() {

		$core = $GLOBALS['core'];
		require_once __DIR__.'/_widgets.php';

		// Adds  news Categories' templates tags :
		$tpl = $core->tpl;
		$tpl->addValue('CategoryCount', array('tplCategories', 'CategoryCount'));
		$tpl->addValue('CategoriesURL', array('tplCategories', 'CategoriesURL'));
		// Adds a new template behavior :
		$core->addBehavior('publicBeforeDocument', array('behaviorCategoriesPage', 'addTplPath'));
		// 'categories' urlHandler :
		$core->url->register('categories', 'categories', '^categories$', array('urlCategories', 'categories'));
		// compatibilité avec Breadcrumb 
		$core->addBehavior('publicBreadcrumb', array('extCategoriesPage', 'publicBreadcrumb'));
	}

}

class tplCategories {
	/*
	  Use tag : {{tpl:CategoryCount}}
    */
	public static function CategoryCount($attr) {
		$f = $GLOBALS['core']->tpl->getFilters($attr);
		return
				'<?php echo ' . sprintf($f, '$_ctx->categories->nb_post') . '; ?>';
	}
	/*
	  Use tag : {{tpl:CategoriesURL}}
	*/
	public static function CategoriesURL($attr) {
		$f = $GLOBALS['core']->tpl->getFilters($attr);
		return
				'<?php echo ' . sprintf($f, '$core->blog->url.$core->url->getBase("categories")') . '; ?>';
	}
}

class behaviorCategoriesPage {

	public static function addTplPath($core) {
		$tplset = $core->themes->moduleInfo($core->blog->settings->system->theme,'tplset');
        if (!empty($tplset) && is_dir(dirname(__FILE__).'/default-templates/'.$tplset)) {
            $core->tpl->setPath($core->tpl->getPath(), dirname(__FILE__).'/default-templates/'.$tplset);
        } else {
            $core->tpl->setPath($core->tpl->getPath(), dirname(__FILE__).'/default-templates/'.DC_DEFAULT_TPLSET);
        }
	}

}

class urlCategories extends dcUrlHandlers {

	public static function categories($args) {
		# The entry
		self::serveDocument('categories.html');
		exit;
	}
}

class extCategoriesPage
{
  public static function publicBreadcrumb($context,$separator)
  {
    if ($context == 'categories') {
      return __('Categories Page');
    }
  }
}
