<?php

namespace Xbigdaddyx\BeverlySolid;

use Illuminate\Database\Eloquent\Model;
use Xbigdaddyx\Beverly\Models\CartonBox;
use Xbigdaddyx\BeverlySolid\Services\SolidService;
use Xbigdaddyx\Fuse\Domain\User\Models\User;

class BeverlySolid
{
    protected $solidService;
    public function __construct(SolidService $solidService)
    {
        $this->solidService = $solidService;
    }
    public function verification(CartonBox $cartonBox, string $polybag_code, int $polybagStatus, ?string $tag_code, User $user, ?string $additional = null)
    {
        return $this->solidService->solidPrinciple($cartonBox, $polybag_code, $user, $additional);
    }
}
