<?php

namespace Newebtime\PagesExtendedExtension\Hasher;

use Illuminate\Http\Request;

class RequestHasher extends \Spatie\ResponseCache\RequestHasher
{
    public function getHashFor(Request $request): string
    {
        $locale = defined('LOCALE') ? LOCALE : $request->getLocale();

        return 'responsecache-'.md5(
            "{$request->getUri()}/{$locale}/{$request->getMethod()}/".$this->cacheProfile->cacheNameSuffix($request)
        );
    }
}
