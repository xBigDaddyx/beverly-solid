<?php

namespace Xbigdaddyx\BeverlySolid\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Xbigdaddyx\BeverlySolid\BeverlySolid
 */
class BeverlySolid extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'BeverlySolid';
    }
}
