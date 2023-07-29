<?php

namespace IbrahimBougaoua\SubscriptionSystem\Resources;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use IbrahimBougaoua\SubscriptionSystem\Models\Plan;
use IbrahimBougaoua\SubscriptionSystem\Models\PlanCurrency;
use IbrahimBougaoua\SubscriptionSystem\Models\PlanFeature;
use IbrahimBougaoua\SubscriptionSystem\Resources\PlanFeatureResource\Pages;
use Illuminate\Database\Eloquent\Builder;
use Str;

class PlanFeatureResource extends Resource
{
    protected static ?string $model = PlanFeature::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Plans';

    protected static ?string $navigationLabel = 'Plan Features';

    protected static ?string $pluralLabel = 'Plan Features';

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
                        TextInput::make('value')
                        ->label('value')
                        ->columnSpan([
                            'md' => 4,
                        ]),
                        TextInput::make('resettable_period')
                        ->label('resettable_period')
                        ->numeric()
                        ->columnSpan([
                            'md' => 4,
                        ]),
                        Select::make('resettable_interval')
                        ->label('resettable_interval')
                        ->options([
                            'month' => 'Month',
                            'day' => 'Day',
                            'year' => 'Year',
                        ])
                        ->columnSpan([
                            'md' => 4,
                        ]),
                        Select::make('status')->label('Status')
                        ->options([
                            '1' => 'Active',
                            '0' => 'Inactive',
                        ])->default('1')->disablePlaceholderSelection()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        Select::make('plan_id')
                        ->label('Plan')
                        ->reactive()
                        ->required()
                        ->options(Plan::all()
                        ->pluck('name', 'id')
                        ->toArray())
                        ->searchable()
                        ->columnSpan([
                            'md' => 6,
                        ]),
                        MarkdownEditor::make('description')->label(__('panel.description'))
                        ->columnSpan([
                            'md' => 12,
                        ]),
                        FileUpload::make('image')->label(__('panel.image'))
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
                TextColumn::make('plan.name')
                ->label('Plan')
                ->sortable()
                ->searchable(),
                TextColumn::make('resettable_period')
                ->label('Resettable Period'),
                TextColumn::make('resettable_interval')
                ->label('Resettable Interval'),
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
            'index' => Pages\ListPlanFeatures::route('/'),
            'create' => Pages\CreatePlanFeature::route('/create'),
            'edit' => Pages\EditPlanFeature::route('/{record}/edit'),
        ];
    }
}
