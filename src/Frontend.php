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
declare(strict_types=1);

namespace Dotclear\Plugin\CategoriesPage;

use ArrayObject;
use dcCore;
use dcNsProcess;

class Frontend extends dcNsProcess
{
    public static function init(): bool
    {
        static::$init = My::phpCompliant();

        return static::$init;
    }

    public static function process(): bool
    {
        if (!static::$init) {
            return false;
        }

        dcCore::app()->addBehaviors([
            // template path
            'publicBeforeDocumentV2' => function (): void {
                // nullsafe PHP < 8.0
                if (is_null(dcCore::app()->blog)) {
                    return ;
                }

                $tplset = dcCore::app()->themes->moduleInfo(dcCore::app()->blog->settings->get('system')->get('theme'), 'tplset');
                if (!empty($tplset) && is_dir(implode(DIRECTORY_SEPARATOR, [My::path(), 'default-templates', $tplset]))) {
                    dcCore::app()->tpl->setPath(dcCore::app()->tpl->getPath(), implode(DIRECTORY_SEPARATOR, [My::path(), 'default-templates', $tplset]));
                } else {
                    dcCore::app()->tpl->setPath(dcCore::app()->tpl->getPath(), implode(DIRECTORY_SEPARATOR, [My::path(), 'default-templates', DC_DEFAULT_TPLSET]));
                }
            },
            // breacrumb addon
            'publicBreadcrumb' => function (string $context, string $separator): string {
                return $context == 'categories' ? My::name() : '';
            },
            // widget
            'initWidgets' => [Widgets::class, 'initWidgets'],
        ]);

        // tpl values
        dcCore::app()->tpl->addValue('CategoryCount', function (ArrayObject $attr): string {
            return '<?php echo ' . sprintf(dcCore::app()->tpl->getFilters($attr), 'dcCore::app()->ctx->categories->nb_post') . '; ?>';
        });
        dcCore::app()->tpl->addValue('CategoriesURL', function (ArrayObject $attr): string {
            return '<?php echo ' . sprintf(dcCore::app()->tpl->getFilters($attr), 'dcCore::app()->blog->url.dcCore::app()->url->getBase("categories")') . '; ?>';
        });

        return true;
    }
}
