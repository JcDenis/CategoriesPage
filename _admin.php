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
# -- END LICENSE BLOCK ------------------------------------*/
if (!defined('DC_CONTEXT_ADMIN')) { 
    return; 
}

categoriespageAdminBehaviors::main();

class categoriespageAdminBehaviors
{
	public static function main() {
            
		require_once '/_widgets.php';
		
		$menu = $GLOBALS['_menu'];
		$core = $GLOBALS['core'];
		$menu['Plugins']->addItem(
				ConstCategoriesPage::NS,
				'plugin.php?p='.ConstCategoriesPage::PARAM,
				'index.php?pf='.ConstCategoriesPage::PARAM.'/icon.png',
				preg_match('/plugin.php\?p='.ConstCategoriesPage::PARAM.'(&.*)?$/',$_SERVER['REQUEST_URI']),
				$core->auth->isSuperAdmin());
        }
}
