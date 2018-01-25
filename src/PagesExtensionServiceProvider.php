<?php

namespace Newebtime\PagesExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Newebtime\PagesExtension\Migration\AnomalyModulePagesCreatePagesStream;
use Newebtime\PagesExtension\Page\Command\SetPath;
use Newebtime\PagesExtension\Page\PageResolver;
use Newebtime\PagesExtension\Page\PageSeeder;
use Newebtime\PagesExtension\Type\TypeSeeder;

class PagesExtensionServiceProvider extends AddonServiceProvider
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
        \Anomaly\PagesModule\Page\PageResolver::class => PageResolver::class,
        \Anomaly\PagesModule\Page\PageSeeder::class   => PageSeeder::class,
        \Anomaly\PagesModule\Type\TypeSeeder::class   => TypeSeeder::class,
        \AnomalyModulePagesCreatePagesStream::class   => AnomalyModulePagesCreatePagesStream::class,
    ];
}
