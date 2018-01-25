<?php

namespace Newebtime\PagesExtension;

use Anomaly\DefaultPageHandlerExtension\Command\MakePage;
use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;

class PagesExtension extends Extension
{
    /**
     * This extension provides the default
     * page handler for the Pages module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.pages::handler.default';

    /**
     * Make the page's response.
     *
     * @param PageInterface $page
     */
    public function make(PageInterface $page)
    {
        $this->dispatch(new MakePage($page));
    }

    /**
     * Route the page's response.
     *
     * @param PageInterface $page
     */
    public function route(PageInterface $page)
    {
        if (!$page->isExact()) {
            foreach ($page->getTranslations()->pluck('path', 'locale')->filter()->toArray() as $locale => $path) {
                \Route::any(
                    $path . '/{any?}',
                    [
                        'uses'                         => 'Anomaly\PagesModule\Http\Controller\PagesController@view',
                        'streams::addon'               => 'anomaly.module.pages',
                        'anomaly.module.pages::page'   => $page->getId(),
                        'anomaly.module.pages::locale' => $locale,
                        'where'                        => [
                            'any' => '(.*)',
                        ],
                    ]
                );
            }

            return;
        }

        foreach ($page->getTranslations()->pluck('path', 'locale')->filter()->toArray() as $locale => $path) {
            \Route::any(
                $path,
                [
                    'uses'                         => 'Anomaly\PagesModule\Http\Controller\PagesController@view',
                    'streams::addon'               => 'anomaly.module.pages',
                    'anomaly.module.pages::page'   => $page->getId(),
                    'anomaly.module.pages::locale' => $page->isHome() ? '*' : $locale,
                ]
            );
        }
    }
}
