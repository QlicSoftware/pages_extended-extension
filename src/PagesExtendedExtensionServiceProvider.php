<?php

namespace Newebtime\PagesExtendedExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Newebtime\PagesExtendedExtension\Hasher\RequestHasher;
use Newebtime\PagesExtendedExtension\Migration\AnomalyModulePagesCreatePagesStream;
use Newebtime\PagesExtendedExtension\Page\Command\SetPath;
use Newebtime\PagesExtendedExtension\Page\Form\PageEntryFormSections;
use Newebtime\PagesExtendedExtension\Page\PageRepository;
use Newebtime\PagesExtendedExtension\Page\PageResolver;
use Newebtime\PagesExtendedExtension\Page\PageSeeder;
use Newebtime\PagesExtendedExtension\Type\TypeSeeder;

class PagesExtendedExtensionServiceProvider extends AddonServiceProvider
{
    /**
     * The addon alias bindings.
     *
     * @type array|null
     */
    protected $aliases = [
        \Anomaly\PagesModule\Page\Command\SetPath::class => SetPath::class,
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        \Anomaly\PagesModule\Page\PageResolver::class               => PageResolver::class,
        \Anomaly\PagesModule\Page\PageSeeder::class                 => PageSeeder::class,
        \Anomaly\PagesModule\Type\TypeSeeder::class                 => TypeSeeder::class,
        \Anomaly\PagesModule\Page\PageRepository::class             => PageRepository::class,
        \AnomalyModulePagesCreatePagesStream::class                 => AnomalyModulePagesCreatePagesStream::class,
        \Anomaly\PagesModule\Page\Form\PageEntryFormSections::class => PageEntryFormSections::class,
        \Spatie\ResponseCache\RequestHasher::class                  => RequestHasher::class,
    ];

    /**
     * Addon providers.
     *
     * @var array
     */
    protected $providers = [
        'Spatie\ResponseCache\ResponseCacheServiceProvider',
        'Silber\PageCache\LaravelServiceProvider',
    ];
}
