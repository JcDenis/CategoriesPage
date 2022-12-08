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

$this->registerModule(
    'Categories Page',
    'Add a public page for categories list',
    'Pierre Van Glabeke, Bernard Le Roux and Contributors',
    '0.7',
    [
        'requires'    => [['core', '2.24']],
        'permissions' => dcCore::app()->auth->makePermissions([
            dcAuth::PERMISSION_ADMIN,
        ]),
        'type'       => 'plugin',
        'support'    => 'https://github.com/JcDenis/CategoriesPage',
        'details'    => 'https://plugins.dotaddict.org/dc2/details/CategoriesPage',
        'repository' => 'https://raw.githubusercontent.com/JcDenis/CategoriesPage/master/dcstore.xml',

    ]
);
