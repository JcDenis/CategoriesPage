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
if (!defined('DC_RC_PATH')) { 
    return; 
}

require_once 'ConstCategoriesPage.php';
$this->registerModule(
	/* Name */          'Categories Page',
	/* Description*/    'Add a category list page /  Ajoute une page listant les catégories',
	/* Author */        'Pierre Van Glabeke, Bernard Le Roux',
	/* Version */		ConstCategoriesPage::VERSION,
	/* Properties */
	array(
		'permissions' => 'admin',
		'type' => 'plugin',
		'dc_min' => '2.5',
		'support' => 'http://forum.dotclear.org/viewforum.php?id=16',
		'details' => 'http://plugins.dotaddict.org/dc2/details/categoriesPage'
	)
);