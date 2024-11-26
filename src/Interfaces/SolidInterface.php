<?php

namespace Xbigdaddyx\BeverlySolid\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Xbigdaddyx\Beverly\Models\CartonBox;
use Xbigdaddyx\Fuse\Domain\User\Models\User;

interface SolidInterface
{
    public function setCompleted(CartonBox $cartonBox, User $user);
    public function checkQuantity(int $polybag_count, int $max);
    public function createSolidPolybag(CartonBox $cartonBox, string $polybag_code, User $user, ?string $additional);
    public function solidPrinciple(CartonBox $cartonBox, string $polybag_code, User $user, ?string $additional);
}
