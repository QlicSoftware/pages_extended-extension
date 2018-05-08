<?php

namespace Newebtime\PagesExtendedExtension;

use Anomaly\DefaultPageHandlerExtension\Command\MakePage;
use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Spatie\ResponseCache\Middlewares\CacheResponse;

class PagesExtendedExtension extends Extension
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
        if (app()->runningInConsole()) {
            $paths = $page->translations()->pluck('path', 'locale')->toArray();
        } else {
            $paths = $page->translations()->where('path', '/'. ltrim(request()->path(), '/'))->pluck('path', 'locale')->toArray();
        }

        if (!$page->isExact()) {
            foreach ($paths as $locale => $path) {
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
                        'middleware' => $page->ttl ? [
                            CacheResponse::class.':'.$page->ttl,
                        ] : [],
                    ]
                );
            }

            return;
        }

        foreach ($paths as $locale => $path) {
            \Route::any(
                $path,
                [
                    'uses'                         => 'Anomaly\PagesModule\Http\Controller\PagesController@view',
                    'streams::addon'               => 'anomaly.module.pages',
                    'anomaly.module.pages::page'   => $page->getId(),
                    'anomaly.module.pages::locale' => $page->isHome() ? '*' : $locale,
                    'middleware' => $page->ttl ? [
                        CacheResponse::class.':'.$page->ttl,
                    ] : [],
                ]
            );
        }
    }
}
