<?php

namespace IbrahimBougaoua\SubscriptionSystem\Resources;

use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use IbrahimBougaoua\SubscriptionSystem\Models\PlanSubscription;
use IbrahimBougaoua\SubscriptionSystem\Resources\PlanSubscriptionsResource\Pages;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class PlanSubscriptionsResource extends Resource
{
    protected static ?string $model = PlanSubscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Plans';

    protected static ?string $navigationLabel = 'Subscribed User Plans';

    protected static ?string $pluralLabel = 'Subscribed User Plans';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    
    protected static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 0 ? 'success' : 'danger';
    }

    public static function canCreate(): bool
    {
        return false;
    }
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Card::make()
            ->schema([
                    TextInput::make('name')
                    ->label('Name')
                    ->disabled()
                    ->columnSpan([
                        'md' => 4,
                    ]),
                    TextInput::make('trial_ends_at')
                    ->label('Trial Ends At')
                    ->disabled()
                    ->columnSpan([
                        'md' => 4,
                    ]),
                    TextInput::make('starts_at')
                    ->label('Starts At')
                    ->disabled()
                    ->columnSpan([
                        'md' => 4,
                    ]),
                    TextInput::make('ends_at')
                    ->label('Ends At')
                    ->disabled()
                    ->columnSpan([
                        'md' => 4,
                    ]),
                    TextInput::make('cancels_at')
                    ->label('Cancels At')
                    ->disabled()
                    ->columnSpan([
                        'md' => 4,
                    ]),
                    TextInput::make('canceled_at')
                    ->label('Canceled at')
                    ->disabled()
                    ->columnSpan([
                        'md' => 4,
                    ]),
                ])
                ->columns([
                'md' => 12
            ])
            ->columnSpan('full'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('subscriber.name')
                ->colors(['secondary'])
                ->limit(8)
                ->label('Subscriber'),
                BadgeColumn::make('name')
                ->label('Plan')
                ->colors(['primary'])
                ->searchable(),
                BadgeColumn::make('price')
                ->label('Price')
                ->suffix(config('filament-subscriptions.currency'))
                ->colors(['success']),
                BadgeColumn::make('trial_ends_at')
                ->label('Trial Ends At')
                ->colors(['secondary']),
                BadgeColumn::make('starts_at')
                ->label('Starts At')
                ->colors(['success']),
                BadgeColumn::make('ends_at')
                ->label('Ends At')
                ->colors(['danger']),
                ToggleColumn::make('is_paid')
                ->label('Unpaid/Paid'),
                BadgeColumn::make('created_at')
                ->label('Created at')
                ->colors(['success'])
            ])
            ->filters([
                SelectFilter::make('is_paid')
                    ->label('Unpaid/Paid')
                    ->options([
                    '1' => 'Paid',
                    '0' => 'Unpaid',
                ]),
                Tables\Filters\Filter::make('created_at')
                ->label('Created at')->form([
                    Forms\Components\DatePicker::make('created_from')->label('Created from'),
                    Forms\Components\DatePicker::make('created_until')->label('Created until'),
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
                })
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ])
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