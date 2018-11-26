<?php

namespace Newebtime\PagesExtendedExtension\Page;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Illuminate\Database\Eloquent\Builder;

class PageRepository extends \Anomaly\PagesModule\Page\PageRepository
{
    /**
     * Find a page by it's path.
     *
     * @param $path
     * @return PageInterface|null
     */
    public function findByPath($path)
    {
        return $this->model
            ->whereHas('translations', function (Builder $query) use ($path) {
                $query->where('locale', app()->getLocale())
                    ->where('path', $path);
            })
            ->first();
    }
}
