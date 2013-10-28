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
if (!defined('DC_CONTEXT_ADMIN')) { return; }

require_once dirname(__FILE__).'/_widgets.php';

$core->addBehavior('adminBlogPreferencesForm',array('categoriespageAdminBehaviors','adminBlogPreferencesForm'));
$core->addBehavior('adminBeforeBlogSettingsUpdate',array('categoriespageAdminBehaviors','adminBeforeBlogSettingsUpdate'));

class categoriespageAdminBehaviors
{
	public static function adminBlogPreferencesForm($core,$settings)
	{
		echo
		'<div class="fieldset"><h4>'.__('Categories Page').'</h4>'.
		'<p><label class="classic">'.
		form::checkbox('categoriespage_active','1',$settings->categoriespage->categoriespage_active).
		__('Enable Categories Page').'</label></p>'.
		'</div>';
	}

	public static function adminBeforeBlogSettingsUpdate($settings)
	{
		$settings->addNameSpace('categoriespage');
		$settings->categoriespage->put('categoriespage_active',!empty($_POST['categoriespage_active']),'boolean');
		$settings->addNameSpace('system');
	}
}
