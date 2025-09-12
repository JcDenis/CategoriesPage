<?php

declare(strict_types=1);

namespace Dotclear\Plugin\CategoriesPage;

use ArrayObject;
use Dotclear\App;
use Dotclear\Helper\Process\TraitProcess;

/**
 * @brief       CategoriesPage frontend class.
 * @ingroup     CategoriesPage
 *
 * @author      Pierre Van Glabeke (author)
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class Frontend
{
    use TraitProcess;

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
        App::frontend()->template()->addValue('CategoriesPageURL', function (ArrayObject $attr): string {
            return '<?php echo ' . sprintf(App::frontend()->template()->getFilters($attr), 'App::blog()->url().App::url()->getBase("categories")') . '; ?>';
        });
        App::frontend()->template()->addValue('CategoriesPageTitle', function (ArrayObject $attr): string {
            return '<?php echo ' . sprintf(App::frontend()->template()->getFilters($attr), My::class . "::settings()->get('page_title') ?: __('Categories')") . '; ?>';
        });
        App::frontend()->template()->addValue('CategoriesPageDescription', function (ArrayObject $attr): string {
            return '<?php echo ' . sprintf(App::frontend()->template()->getFilters($attr), My::class . "::settings()->get('page_desc') ?: ''") . '; ?>';
        });
        App::frontend()->template()->addBlock('CategoryComments', function (ArrayObject $attr, string $content): string {
            $p = 
                '$params[\'cat_id\'] = App::frontend()->context()->categories->cat_id;' .
                '$params[\'order\'] = \'comment_dt desc\';' .
                '$params[\'no_content\'] = true;';

            $lastn = 0;
            if (isset($attr['lastn'])) {
                $lastn = abs((int) $attr['lastn']) + 0;
            }
            if ($lastn > 0) {
                $p .= '$params[\'limit\'] = ' . $lastn . ';';
            }
            if (isset($attr['no_content']) && $attr['no_content']) {
                $p .= '$params[\'no_content\'] = true;';
            }
        
            return 
                '<?php ' . $p . 
                'App::frontend()->context()->comments_params = $params;' .
                'App::frontend()->context()->comments = App::blog()->getComments($params); unset($params);' .
                'while (App::frontend()->context()->comments->fetch()) : ' .
                'App::frontend()->context()->posts = App::blog()->getPosts([\'post_id\' => App::frontend()->context()->comments->post_id]);' .
                '?>' .
                $content .
                '<?php endwhile; App::frontend()->context()->pop("comments"); ?>';
        });

        return true;
    }
}
