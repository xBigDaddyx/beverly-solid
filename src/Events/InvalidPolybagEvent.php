<?php

namespace Xbigdaddyx\BeverlySolid\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Xbigdaddyx\Beverly\Models\CartonBox;

class InvalidPolybagEvent
{
    use Dispatchable;

    public $cartonBox;

    public function __construct(CartonBox $cartonBox)
    {
        $this->cartonBox = $cartonBox;
    }
}
