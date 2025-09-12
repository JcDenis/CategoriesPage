<?php

declare(strict_types=1);

namespace Dotclear\Plugin\CategoriesPage;

use ArrayObject;
use Dotclear\App;
use Dotclear\Helper\Process\TraitProcess;
use Dotclear\Helper\Html\Form\Fieldset;
use Dotclear\Helper\Html\Form\Input;
use Dotclear\Helper\Html\Form\Label;
use Dotclear\Helper\Html\Form\Legend;
use Dotclear\Helper\Html\Form\Para;
use Dotclear\Helper\Html\Form\Textarea;
use Dotclear\Helper\Html\Html;
use Dotclear\Interface\Core\BlogSettingsInterface;

/**
 * @brief       CategoriesPage backend class.
 * @ingroup     CategoriesPage
 *
 * @author      Pierre Van Glabeke (author)
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class Backend
{
    use TraitProcess;

    public static function init(): bool
    {
        return self::status(My::checkContext(My::BACKEND));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        App::behavior()->addBehaviors([
            'initWidgets'            => Widgets::initWidgets(...),
            'adminSimpleMenuAddType' => function (ArrayObject $items): void {
                $items[My::id()] = new ArrayObject([My::name(), false]);
            },
            'adminSimpleMenuBeforeEdit' => function (string $type, string $select, array &$item): void {
                if (My::id() == $type) {
                    $item[0] = My::name();
                    $item[1] = My::name();
                    $item[2] = Html::stripHostURL(App::blog()->url()) . App::url()->getURLFor(My::id());
                }
            },
            'adminBlogPreferencesFormV2' => function (BlogSettingsInterface $blog_settings): void {
                echo (new Fieldset(My::id() . '_params'))
                    ->legend(new Legend(My::name()))
                    ->items([
                        (new Para())
                            ->items([
                                (new Input(My::id() . 'page_title'))
                                    ->class('maximal')
                                    ->size(65)
                                    ->maxlength(255)
                                    ->value($blog_settings->get(My::id())->get('page_title'))
                                    ->label(new Label(__('Public categories page title:'), Label::OL_TF)),
                        ]),
                        (new Para())
                            ->items([
                                (new Textarea(My::id() . 'page_desc', Html::escapeHTML((string) $blog_settings->get(My::id())->get('page_desc'))))
                                    ->rows(6)
                                    ->class('maximal')
                                    ->label((new Label(__('Public categories page description:'), Label::OL_TF))),
                            ]),
                    ])
                    ->render();
            },
            'adminBeforeBlogSettingsUpdate' => function (BlogSettingsInterface $blog_settings): void {
                $blog_settings->get(My::id())->put('page_title', (string) $_POST[My::id() . 'page_title']);
                $blog_settings->get(My::id())->put('page_desc', (string) $_POST[My::id() . 'page_desc']);
            },
            //'adminBlogPreferencesHeaders' => fn (): string => My::jsLoad('backend'),
            'adminPostEditorTags' => function (string $editor, string $context, ArrayObject $alt_tags, string $format): void {
                // there is an existsing postEditor on this page, so we add our textarea to it
                if ($context === 'blog_desc') {
                    $alt_tags->append('#' . My::id() . 'page_desc');
                }
            },
        ]);

        return true;
    }
}
