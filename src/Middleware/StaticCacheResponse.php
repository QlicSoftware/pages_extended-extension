<?php

namespace Newebtime\PagesExtendedExtension\Middleware;

use Silber\PageCache\Cache;
use Silber\PageCache\Middleware\CacheResponse;

class StaticCacheResponse extends CacheResponse
{
    /**
     * Constructor.
     *
     * @var \Silber\PageCache\Cache $cache
     *
     * @throws \Exception
     */
    public function __construct(Cache $cache)
    {
        parent::__construct($cache);

        if (defined('LOCALE')) {
            $this->cache->setCachePath($this->cache->getCachePath() .'/'. LOCALE);
        }
    }
}
