<?php

declare(strict_types=1);

namespace Dotclear\Plugin\CategoriesPage;

use ArrayObject;
use Dotclear\App;
use Dotclear\Core\Process;

/**
 * @brief       CategoriesPage frontend class.
 * @ingroup     CategoriesPage
 *
 * @author      Pierre Van Glabeke (author)
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class Frontend extends Process
{
    public static function init(): bool
    {
        return self::status(My::checkContext(My::FRONTEND));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        App::behavior()->addBehaviors([
            // template path
            'publicBeforeDocumentV2' => function (): void {
                $tplset = App::themes()->getDefine(App::blog()->settings()->get('system')->get('theme'))->get('tplset');
                if (empty($tplset) || !is_dir(implode(DIRECTORY_SEPARATOR, [My::path(), 'default-templates', $tplset]))) {
                    $tplset = App::config()->defaultTplset();
                }
                App::frontend()->template()->appendPath(implode(DIRECTORY_SEPARATOR, [My::path(), 'default-templates', $tplset]));
            },
            // breacrumb addon
            'publicBreadcrumb' => fn (string $context, string $separator) => $context == 'categories' ? My::name() : '',
            // widget
            'initWidgets' => Widgets::initWidgets(...),
        ]);

        // tpl values
        App::frontend()->template()->addValue('CategoryCount', function (ArrayObject $attr): string {
            return '<?php echo ' . sprintf(App::frontend()->template()->getFilters($attr), 'App::frontend()->context()->categories->nb_post') . '; ?>';
        });
        App::frontend()->template()->addValue('CategoriesURL', function (ArrayObject $attr): string {
            return '<?php echo ' . sprintf(App::frontend()->template()->getFilters($attr), 'App::blog()->url().App::url()->getBase("categories")') . '; ?>';
        });

        return true;
    }
}
