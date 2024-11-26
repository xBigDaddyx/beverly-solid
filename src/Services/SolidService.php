<?php

namespace Xbigdaddyx\BeverlySolid\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Xbigdaddyx\Beverly\Models\CartonBox;
use Xbigdaddyx\BeverlySolid\Interfaces\SolidInterface;
use Xbigdaddyx\BeverlySolid\Models\SolidPolybag;
use Xbigdaddyx\Fuse\Domain\User\Models\User;
use Filament\Notifications\Notification;
use Filament\Support\Enums\IconSize;

class SolidService implements SolidInterface
{
    public function checkQuantity(int $polybag_count, int $max)
    {
        if ($polybag_count === ($max - 1) || $polybag_count === $max) {
            return true;
        }
        return false;
    }
    public function setCompleted(CartonBox $cartonBox, User $user)
    {
        $cartonBox->is_completed = true;
        $cartonBox->locked_at = Carbon::now();
        $cartonBox->completed_at = Carbon::now();
        $cartonBox->completed_by = $user->id;
        $cartonBox->save();
    }
    public function createSolidPolybag(CartonBox $cartonBox, string $polybag_code, User $user, ?string $additional)
    {
        $polybag = new SolidPolybag([
            'polybag_code' => $polybag_code,
            'status' => 'Validated',
            'additional' => $additional,
        ]);

        if ($this->checkQuantity($cartonBox->solidPolybags->count(), $cartonBox->quantity)) {
            $this->setCompleted($cartonBox, $user);
            $cartonBox->solidPolybags()->save($polybag);
            return redirect(route('filament.beverly.completed.carton.release', ['carton' => $cartonBox->id]));
        }

        $cartonBox->solidPolybags()->save($polybag);
    }
    public function solidPrinciple(CartonBox $cartonBox, string $polybag_code, User $user, ?string $additional)
    {

        if ($cartonBox->is_completed !== true) {
            if ($cartonBox->attributes()->exists()) {
                if ($polybag_code !== $cartonBox->attributes->first()->tag) {
                    Notification::make()

                        ->title('Invalid Polybag')
                        ->body('Please check the polybag may wrong size or color.')
                        ->seconds(10)
                        ->color('danger')
                        ->icon('heroicon-o-document-text')
                        ->iconColor('danger')
                        ->send();
                    return [
                        'title' => 'Invalid Polybag',
                        'text' => 'Please check the polybag may wrong size or color.',
                        'icon' => 'error',
                        'allowOutsideClick' => false,
                        'showConfirmButton' => true,

                    ];
                }
            } else {
                Notification::make()
                    ->title('!Error')
                    ->body('There is no attribute for this carton box, please check with your admin.')
                    ->seconds(10)
                    ->color('danger')
                    ->icon('heroicon-o-document-text')
                    ->iconColor('danger')
                    ->send();
                return [

                    'title' => 'Error!',
                    'text' => 'There is no attribute for this carton box, please check with your admin.',
                    'icon' => 'error',
                    'allowOutsideClick' => false,
                    'showConfirmButton' => true,

                ];
            }
            $this->createSolidPolybag($cartonBox, $polybag_code, $user, $additional);
            return Notification::make()
                ->title('Validated')
                ->body('Polybag has been validated, go for next.')
                ->seconds(10)
                ->color('success')
                ->icon('heroicon-o-document-text')
                ->iconColor('success')
                ->send();
        }
    }
}
