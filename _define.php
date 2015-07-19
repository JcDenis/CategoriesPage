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
$this->registerModule(
	/* Name */          'CategoriesPage',
	/* Description*/    'Add a category list page',
	/* Author */        'Pierre Van Glabeke, Bernard Le Roux',
	/* Version */		    '0.5',
	/* Properties */
	array(
		'permissions' => 'admin',
		'type' => 'plugin',
		'dc_min' => '2.8',
		'support' => 'http://forum.dotclear.org/viewtopic.php?pid=326224#p326224',
		'details' => 'http://plugins.dotaddict.org/dc2/details/categoriesPage'
	)
);