<?php

namespace Newebtime\PagesExtension\Page;

use Anomaly\PagesModule\Page\PageResolver as DefaultResolver;

class PageResolver extends DefaultResolver
{
    /**
     * @inheritdoc
     */
    public function resolve()
    {
        $action = $this->route->getAction();

        if ($id = array_get($action, 'anomaly.module.pages::page')) {
            $locale = array_get($action, 'anomaly.module.pages::locale');

            if (app()->getLocale() === $locale || $locale = '*') {
                return $this->pages->find($id);
            }

            return null;
        }

        if ($path = array_get($action, 'anomaly.module.pages::path')) {
            return $this->pages->findByPath($path);
        }

        return null;
    }
}
