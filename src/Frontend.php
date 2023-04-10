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

require __DIR__ . '/_widgets.php';

// public behavior
dcCore::app()->addBehavior('publicBeforeDocumentV2', function () {
    $tplset = dcCore::app()->themes->moduleInfo(dcCore::app()->blog->settings->system->theme, 'tplset');
    if (!empty($tplset) && is_dir(__DIR__ . '/default-templates/' . $tplset)) {
        dcCore::app()->tpl->setPath(dcCore::app()->tpl->getPath(), __DIR__ . '/default-templates/' . $tplset);
    } else {
        dcCore::app()->tpl->setPath(dcCore::app()->tpl->getPath(), __DIR__ . '/default-templates/' . DC_DEFAULT_TPLSET);
    }
});

// breacrumb addon
dcCore::app()->addBehavior('publicBreadcrumb', function ($context, $separator) {
    if ($context == 'categories') {
        return __('Categories Page');
    }
});

// tpl values
dcCore::app()->tpl->addValue('CategoryCount', function ($attr) {
    return '<?php echo ' . sprintf(dcCore::app()->tpl->getFilters($attr), 'dcCore::app()->ctx->categories->nb_post') . '; ?>';
});
dcCore::app()->tpl->addValue('CategoriesURL', function ($attr) {
    return '<?php echo ' . sprintf(dcCore::app()->tpl->getFilters($attr), 'dcCore::app()->blog->url.dcCore::app()->url->getBase("categories")') . '; ?>';
});
