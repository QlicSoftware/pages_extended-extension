<?php

namespace Newebtime\PagesExtendedExtension\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;

class SetPath
{
    /**
     * The page instance.
     *
     * @var PageInterface
     */
    protected $page;

    /**
     * Create a new SetPath instance.
     *
     * @param PageInterface $page
     */
    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (!$this->page->isEnabled()) {
            $paths = ['en' => ['path' => 'pages/preview/' . $this->page->getStrId()]];
        } else {
            $paths = [];

            foreach ($this->page->getTranslations() as $translation) {
                if ($parent = $this->page->getParent()) {
                    $trans = $parent->getTranslations()->where('locale', $translation->getLocale())->first();

                    $paths[$translation->getLocale()] = [
                        'path' => ($parent->isHome() ? $trans->slug : $trans->path) . '/' . $translation->slug
                    ];
                } elseif ($this->page->isHome()) {
                    $paths[$translation->getLocale()] = ['path' => '/'];
                } else {
                    $paths[$translation->getLocale()] = ['path' => '/' . $translation->slug];
                }
            }
        }

        $this->page->fill($paths);
    }
}
