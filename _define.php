<?php
/**
 * @file
 * @brief       The plugin CategoriesPage definition
 * @ingroup     CategoriesPage
 *
 * @defgroup    CategoriesPage Plugin CategoriesPage.
 *
 * Add a public page for categories list.
 *
 * @author      Pierre Van Glabeke (author)
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
declare(strict_types=1);

$this->registerModule(
    'Categories Page',
    'Add a public page for categories list',
    'Pierre Van Glabeke, Bernard Le Roux and Contributors',
    '1.3.2',
    [
        'requires'    => [['core', '2.28']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'support'     => 'https://github.com/JcDenis/' . basename(__DIR__) . '/issues',
        'details'     => 'https://github.com/JcDenis/' . basename(__DIR__) . '/src/branch/master/README.md',
        'repository'  => 'https://github.com/JcDenis/' . basename(__DIR__) . '/raw/branch/master/dcstore.xml',

    ]
);
