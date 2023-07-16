<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources;

use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use IbrahimBougaoua\FilamentSubscription\Models\Feature;
use IbrahimBougaoua\FilamentSubscription\Models\Plan;
use IbrahimBougaoua\FilamentSubscription\Models\Currency;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanResource\Pages;
use Illuminate\Database\Eloquent\Builder;
use Str;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Plans';

    protected static ?string $navigationLabel = 'Plans';

    protected static ?string $pluralLabel = 'Plans';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    
    protected static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 0 ? 'success' : 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        TextInput::make('name')->label('Name')->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $set('slug', Str::slug($state));
                        })
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->disabled()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        Select::make('currency_id')->label('Currency')
                        ->reactive()
                        ->required()
                        ->options(Currency::all()
                        ->pluck('name', 'id')
                        ->toArray())
                        ->searchable()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        TextInput::make('price')
                        ->label('price')
                        ->numeric()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        TextInput::make('signup_fee')
                        ->label('signup_fee')
                        ->numeric()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        TextInput::make('trial_period')
                        ->label('trial_period')
                        ->numeric()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        Select::make('trial_interval')
                        ->label('trial_interval')
                        ->options([
                            'month' => 'Month',
                            'day' => 'Day',
                            'year' => 'Year',
                        ])
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        TextInput::make('invoice_period')
                        ->label('invoice_period')
                        ->numeric()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        Select::make('invoice_interval')
                        ->label('invoice_interval')
                        ->options([
                            'month' => 'Month',
                            'day' => 'Day',
                            'year' => 'Year',
                        ])
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        TextInput::make('grace_period')
                        ->label('grace_period')
                        ->numeric()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        Select::make('grace_interval')
                        ->label('grace_interval')
                        ->options([
                            'month' => 'Month',
                            'day' => 'Day',
                            'year' => 'Year',
                        ])
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        TextInput::make('prorate_day')
                        ->label('prorate_day')
                        ->numeric()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        TextInput::make('prorate_period')
                        ->label('prorate_period')
                        ->numeric()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        TextInput::make('prorate_extend_due')
                        ->label('prorate_extend_due')
                        ->numeric()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        TextInput::make('active_subscribers_limit')
                        ->label('active_subscribers_limit')
                        ->numeric()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        Select::make('status')->label('Status')
                        ->options([
                            '1' => 'Active',
                            '0' => 'Inactive',
                        ])->default('1')
                        ->disablePlaceholderSelection()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        MarkdownEditor::make('description')
                        ->label(__('panel.description'))
                        ->columnSpan([
                            'md' => 12,
                        ]),
                        FileUpload::make('image')
                        ->label(__('panel.image'))
                        ->columnSpan([
                            'md' => 12,
                        ]),
                    ])
                    ->columns([
                        'md' => 12,
                    ])
                    ->columnSpan('full'),
                    
                    Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('All Features'),
                        CheckboxList::make('features')
                        ->relationship('features', 'id')
                        ->label('')
                        ->options(
                            Feature::pluck('name','id')->toArray()
                        )
                        ->columns(3)
                        ->columnSpan([
                            'md' => 12,
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
                ImageColumn::make('image')
                ->label('Image')
                ->circular(),
                TextColumn::make('name')
                ->label('Name')
                ->icon('heroicon-o-document-text')
                ->sortable()
                ->searchable(),
                TextColumn::make('price')
                ->label('Price')
                ->sortable()
                ->searchable(),
                BadgeColumn::make('features_count')
                ->label('Features')
                ->color(static function ($state): string {
                    if ($state === 0) {
                        return 'danger';
                    }
                    return 'success';
                })
                ->counts('features'),
                BadgeColumn::make('subscriptions_count')
                ->label('Subscriptions')
                ->color(static function ($state): string {
                    if ($state === 0) {
                        return 'danger';
                    }
                    return 'success';
                })
                ->counts('subscriptions'),
                IconColumn::make('status')
                ->label('Status')->boolean()
                ->trueIcon('heroicon-o-badge-check')
                ->falseIcon('heroicon-o-x-circle'),
                TextColumn::make('created_at')->label('Created at'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')->options([
                    '1' => 'Active',
                    '0' => 'Inactive',
                ]),
                Filter::make('created_at')
                    ->label(__('panel.created_at'))->form([
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
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
