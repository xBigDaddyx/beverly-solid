<?php

namespace Xbigdaddyx\BeverlySolid\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Xbigdaddyx\BeverlySolid\Models\SolidPolybag;

trait HasSolidPolybag
{
    public function solidPolybags(): HasMany
    {
        return $this->hasMany(SolidPolybag::class);
    }
}
