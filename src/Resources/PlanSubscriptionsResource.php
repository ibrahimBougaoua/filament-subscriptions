<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentSubscription\Models\PlanSubscription;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanSubscriptionsResource\Pages;
use Illuminate\Database\Eloquent\Builder;

class PlanSubscriptionsResource extends Resource
{
    protected static ?string $model = PlanSubscription::class;

    protected static ?string $navigationIcon = 'icon-subscribed';

    public static function getLabel(): ?string
    {
        return __('ui.subscribed_user_plans');
    }

    public static function getPluralLabel(): ?string
    {
        return __('ui.subscribed_user_plans');
    }

    public static function getNavigationLabel(): string
    {
        return __('ui.subscribed_user_plans');
    }

    public static function getNavigationGroup(): string
    {
        return __('ui.plans');
    }

    protected static ?string $recordTitleAttribute = 'name';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('ui.name'))
                            ->disabled()
                            ->columnSpan([
                                'md' => 4,
                            ]),
                        TextInput::make('trial_ends_at')
                            ->label(__('ui.trial_ends_at'))
                            ->disabled()
                            ->columnSpan([
                                'md' => 4,
                            ]),
                        TextInput::make('starts_at')
                            ->label(__('ui.starts_at'))
                            ->disabled()
                            ->columnSpan([
                                'md' => 4,
                            ]),
                        TextInput::make('ends_at')
                            ->label(__('ui.ends_at'))
                            ->disabled()
                            ->columnSpan([
                                'md' => 4,
                            ]),
                        TextInput::make('cancels_at')
                            ->label(__('ui.cancels_at'))
                            ->disabled()
                            ->columnSpan([
                                'md' => 4,
                            ]),
                        TextInput::make('canceled_at')
                            ->label(__('ui.canceled_at'))
                            ->disabled()
                            ->columnSpan([
                                'md' => 4,
                            ]),
                    ])
                    ->columns([
                        'md' => 12,
                    ])
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('subscriber.name')
                    ->badge()
                    ->colors(['secondary'])
                    ->limit(8)
                    ->label(__('ui.subscriber')),
                TextColumn::make('name')
                    ->badge()
                    ->label(__('ui.name'))
                    ->colors(['primary'])
                    ->searchable(),
                TextColumn::make('price')
                    ->badge()
                    ->label(__('ui.price'))
                    ->suffix(config('filament-subscriptions.currency'))
                    ->colors(['success']),
                TextColumn::make('trial_ends_at')
                    ->badge()
                    ->label(__('ui.trial_ends_at'))
                    ->colors(['secondary']),
                TextColumn::make('starts_at')
                    ->badge()
                    ->label(__('ui.starts_at'))
                    ->colors(['success']),
                TextColumn::make('ends_at')
                    ->badge()
                    ->label(__('ui.ends_at'))
                    ->colors(['danger']),
                ToggleColumn::make('is_paid')
                    ->label(__('ui.unpaid_paid')),
                TextColumn::make('created_at')
                    ->badge()
                    ->label(__('ui.created_at'))
                    ->colors(['success']),
            ])
            ->filters([
                SelectFilter::make('is_paid')
                    ->label(__('ui.unpaid_paid'))
                    ->options([
                        '1' => __('ui.paid'),
                        '0' => __('ui.unpaid'),
                    ]),
                Tables\Filters\Filter::make('created_at')
                    ->label('Created at')->form([
                        Forms\Components\DatePicker::make('created_from')->label(__('ui.created_from')),
                        Forms\Components\DatePicker::make('created_until')->label(__('ui.created_until')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePlanSubscriptions::route('/'),
        ];
    }
}
