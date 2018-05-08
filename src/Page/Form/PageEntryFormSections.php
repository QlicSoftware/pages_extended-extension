<?php

namespace Newebtime\PagesExtendedExtension\Page\Form;

use Anomaly\PagesModule\Page\Form\PageEntryFormBuilder;

class PageEntryFormSections extends \Anomaly\PagesModule\Page\Form\PageEntryFormSections
{
    /**
     * Handle the form sections.
     *
     * @param PageEntryFormBuilder $builder
     */
    public function handle(PageEntryFormBuilder $builder)
    {
        parent::handle($builder);

        $builder->addSectionTab('page', 'cache', [
            'title'  => 'newebtime.extension.pages_extended::tab.cache',
            'fields' => [
                'page_cache_type',
                'page_ttl',
            ],
        ]);
    }
}
