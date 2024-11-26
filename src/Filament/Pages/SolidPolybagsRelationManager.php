<?php

namespace Xbigdaddyx\BeverlySolid\Filament\Pages;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use stdClass;
use Xbigdaddyx\BeverlySolid\Enums\SolidPolybagStatus;

class SolidPolybagsRelationManager extends RelationManager
{
    protected static string $relationship = 'solidPolybags';

    protected static ?string $title = 'Solid Polybags';
    protected static ?string $recordTitleAttribute = 'polybag_code';
    public function isReadOnly(): bool
    {
        return true;
    }
    public static function getIcon(Model $ownerRecord, string $pageClass): ?string
    {
        return 'tabler-paper-bag';
    }
    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->solidPolybags->count();
    }
    public static function getBadgeColor(Model $ownerRecord, string $pageClass): ?string
    {
        return 'success';
    }
    public static function getBadgeTooltip(Model $ownerRecord, string $pageClass): ?string
    {
        return 'There are new polybags has ben validated.';
    }
    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return $ownerRecord->type === 'SOLID';
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Information')
                    ->schema([
                        Forms\Components\TextInput::make('polybag_code')
                            ->label('Polybag Code'),
                    ])->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table

            ->recordTitleAttribute('polybag_code')
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('No')
                    ->state(
                        static function (Tables\Contracts\HasTable $livewire, stdClass $rowLoop): string {
                            return (string) (
                                $rowLoop->iteration +
                                ($livewire->getTableRecordsPerPage() * (
                                    $livewire->getTablePage() - 1
                                ))
                            );
                        }
                    ),
                Tables\Columns\TextColumn::make('uuid')
                    ->searchable()
                    ->sortable()
                    ->label('#'),
                Tables\Columns\TextColumn::make('box.box_code')
                    ->label('Box Code'),
                Tables\Columns\TextColumn::make('polybag_code')
                    ->label('Polybag Code'),
                Tables\Columns\TextColumn::make('additional')
                    ->toggleable(isToggledHiddenByDefault: fn($state): bool => $state === null)
                    ->label('LPN'),
                Tables\Columns\TextColumn::make('box.attributes.color')
                    // ->hidden(fn (RelationManager $livewire): bool => $livewire->ownerRecord->type === 'RATIO' || $livewire->ownerRecord->type === 'MIX')
                    ->label('Color'),
                Tables\Columns\TextColumn::make('box.attributes.size')
                    // ->hidden(fn (RelationManager $livewire): bool => $livewire->ownerRecord->type === 'RATIO' || $livewire->ownerRecord->type === 'MIX')
                    ->label('Size'),

                Tables\Columns\TextColumn::make('box.type')
                    ->icon('tabler-badge')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'SOLID' => 'danger',
                        'MIX' => 'warning',
                        'RATIO' => 'success',
                    })
                    ->searchable()
                    ->label('Type'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(SolidPolybagStatus::class)
                    ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->icon('tabler-calendar')
                    ->iconColor('warning')
                    ->dateTime()
                    ->label('Validated At'),
                Tables\Columns\TextColumn::make('creator.name')
                    ->icon('tabler-user')
                    ->iconColor('danger')
                    ->label('Validated By'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                FilamentExportHeaderAction::make('solid_polybag_export')
                    ->visible(fn(): bool => Auth::user()->can(Config('beverly-solid::permissions.export_solid_polybag')))
                    ->defaultFormat('xlsx')
                    ->label('Export'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
