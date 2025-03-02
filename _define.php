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
    '1.3.3',
    [
        'requires'    => [['core', '2.28']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'support'     => 'https://github.com/JcDenis/' . $this->id . '/issues',
        'details'     => 'https://github.com/JcDenis/' . $this->id . '/',
        'repository'  => 'https://raw.githubusercontent.com/JcDenis/' . $this->id . '/master/dcstore.xml',
        'date'        => '2025-02-24T23:31:12+00:00',

    ]
);
