<?php


namespace Xbigdaddyx\BeverlySolid\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum SolidPolybagStatus: string implements HasLabel, HasColor, HasIcon, HasDescription
{
    case VALIDATED = 'Validated';
    case UNVALIDATED = 'Unvalidated';
    case OPENED = 'Opened';
    case CLOSED = 'Closed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::VALIDATED => 'Validated',
            self::UNVALIDATED => 'Unvalidated',
            self::OPENED => 'Opened',
            self::CLOSED => 'Closed'
        };
    }
    public function getColor(): string | array | null
    {
        return match ($this) {
            self::VALIDATED => 'success',
            self::UNVALIDATED => 'danger',
            self::OPENED => 'warning',
            self::CLOSED => 'info'
        };
    }
    public function getIcon(): ?string
    {
        return match ($this) {
            self::VALIDATED => 'tabler-discount-check',
            self::UNVALIDATED => 'tabler-circle-x',
            self::OPENED => 'tabler-lock-open',
            self::CLOSED => 'tabler-lock'
        };
    }
    public function getDescription(): ?string
    {
        return match ($this) {
            self::VALIDATED => 'This has been validated by validation officer',
            self::UNVALIDATED => 'This has not validated by validation officer',
            self::OPENED => 'This is ready for validation',
            self::CLOSED => 'This has been validated and locked by validation officer',
        };
    }
}
