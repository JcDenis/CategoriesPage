<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of Categories Page, a plugin for Dotclear 2.
#
# Copyright (c) 2007-2011 Adjaya and contributors
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK ------------------------------------
if (!defined('DC_RC_PATH')) { return; }

$this->registerModule(
	/* Name */			"Categories Page",
	/* Description*/		"Add a category list page",
	/* Author */		"Adjaya, Pierre Van Glabeke",
	/* Version */		'0.1',
	/* Properties */
	array(
		'permissions' => 'admin',
		'type' => 'plugin',
		'dc_min' => '2.5',
		'support' => 'http://forum.dotclear.org/viewforum.php?id=16',
		'details' => 'http://plugins.dotaddict.org/dc2/details/categoriesPage'
	)
);
