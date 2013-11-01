<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of categoriesMode, a plugin for Dotclear 2.
#
# Copyright (c) 2007-2011 Adjaya and contributors
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_CONTEXT_ADMIN')) { 
    exit; 
}

indexCategoriesPage::main();


class indexCategoriesPage {
    public static function main() {
        require_once 'ConstCategoriesPage.php';
        $core = $GLOBALS['core'];
        $ns = $core->blog->settings->addNameSpace( ConstCategoriesPage::NS);
        if ( $ns->get(ConstCategoriesPage::PLUGIN_IS_ACTIVE) === null) {
                try {
                    $ns->put( ConstCategoriesPage::PLUGIN_IS_ACTIVE, false, 'boolean');

                    # Url de base
                    $p_url = 'plugin.php?p='.ConstCategoriesPage::PARAM;
                    http::redirect($p_url);
                }
                catch (Exception $e) {
                    $core->error->add($e->getMessage());
                }
        }

    $active = $ns->get( ConstCategoriesPage::PLUGIN_IS_ACTIVE);
    $msg = '';
    if (!empty($_POST['saveconfig'])) {
            try {
                $active = (empty($_POST['active'])) ? false : true;
                $ns->put( ConstCategoriesPage::PLUGIN_IS_ACTIVE, $active,'boolean');
                $core->blog->triggerBlog();
                $msg = dcPage::success( __('Configuration successfully updated.'), true, false, false);
            }
            catch (Exception $e) {
                $core->error->add($e->getMessage());
            }
    }
    $page_title = __('Categories Page');
    echo '  
<html>
<head>
        <title>'. $page_title.'</title>
</head>
<body>' .
    dcPage::breadcrumb(
        array(
                html::escapeHTML($core->blog->name) => '',
                '<span class="page-title">'.$page_title.'</span>' => ''
        )).$msg.        
'<div id="categoriesmode_options">
    <form method="post" action="plugin.php">
    <div class="fieldset">
            <h4>'. __('Plugin activation').'</h4>
            <p class="field">
            <label class=" classic">'. form::checkbox('active', 1, $active).'&nbsp;'.
            __('Enable categoriesMode').
            '</label>
            </p>
    </div>
   <p>
  <input type="hidden" name="p" value="'.ConstCategoriesPage::PARAM.'" />'.
  $core->formNonce().
  '<input type="submit" name="saveconfig" value="'. __('Save configuration').'" />
  </p>
  </form>
</div>
</body>
</html>';
}
}
