<?php

namespace Newebtime\PagesExtendedExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Newebtime\PagesExtendedExtension\Migration\AnomalyModulePagesCreatePagesStream;
use Newebtime\PagesExtendedExtension\Page\Command\SetPath;
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
        \Anomaly\PagesModule\Page\PageResolver::class => PageResolver::class,
        \Anomaly\PagesModule\Page\PageSeeder::class   => PageSeeder::class,
        \Anomaly\PagesModule\Type\TypeSeeder::class   => TypeSeeder::class,
        \AnomalyModulePagesCreatePagesStream::class   => AnomalyModulePagesCreatePagesStream::class,
    ];
}
